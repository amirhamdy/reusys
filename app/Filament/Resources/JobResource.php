<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Widgets\JobStats;
use App\Models\Job;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobResource\Pages;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = '  ';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    BelongsToSelect::make('project_id')
                        ->rules(['required', 'exists:projects,id'])
                        ->relationship('project', 'name')->preload()
                        ->searchable()
                        ->placeholder('Project')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    BelongsToSelect::make('source_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('sourceLanguage', 'name')->preload()
                        ->searchable()
                        ->placeholder('Source Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('target_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('targetLanguage', 'name')->preload()
                        ->searchable()
                        ->placeholder('Target Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('job_type_id')
                        ->rules(['required', 'exists:job_types,id'])
                        ->relationship('jobType', 'name')->preload()
                        ->searchable()
                        ->placeholder('Job Type')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('job_unit_id')
                        ->rules(['required', 'exists:job_units,id'])
                        ->relationship('jobUnit', 'name')->preload()
                        ->searchable()
                        ->placeholder('Job Unit')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    TextInput::make('amount')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Amount')
                        ->default(1)
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('cost')
                        ->rules(['required', 'numeric'])
                        ->numeric()->disabled()
                        ->placeholder('Cost')
                        ->default(0)
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    Toggle::make('is_free_job')
                        ->label('Mark as a free job')
                        ->rules(['required', 'boolean'])
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    Toggle::make('is_minimum_charge_used')
                        ->label('Apply minimum charge for this job')
                        ->rules(['required', 'boolean'])
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),
                ]),
            ])->columns(2)->columnSpan(['lg' => fn(?Job $record) => $record === null ? 3 : 2]),

            Card::make()->schema([
                Forms\Components\Placeholder::make('created_at')
                    ->label('Created at')
                    ->content(fn(Job $record): string => $record->created_at->diffForHumans()),

                Forms\Components\Placeholder::make('updated_at')
                    ->label('Last modified at')
                    ->content(fn(Job $record): string => $record->updated_at->diffForHumans()),
            ])->columnSpan(['lg' => 1])->hidden(fn(?Job $record) => $record === null),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID'),
                Tables\Columns\TextColumn::make('name')->limit(30)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('project.name')->limit(30)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sourceLanguage.name')->limit(20)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('targetLanguage.name')->limit(20)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jobType.name')->limit(30)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jobUnit.name')->limit(30)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\BooleanColumn::make('is_free_job'),
                Tables\Columns\BooleanColumn::make('is_minimum_charge_used'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                            $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                            $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('project_id')->relationship(
                    'project',
                    'name'
                ),

                MultiSelectFilter::make('source_language_id')->relationship(
                    'sourceLanguage',
                    'name'
                ),

                MultiSelectFilter::make('target_language_id')->relationship(
                    'targetLanguage',
                    'name'
                ),

                MultiSelectFilter::make('job_type_id')->relationship(
                    'jobType',
                    'name'
                ),

                MultiSelectFilter::make('job_unit_id')->relationship(
                    'jobUnit',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [JobResource\RelationManagers\TasksRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'view' => Pages\ViewJob::route('/{record}'),
//            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getWidgets(): array
    {
        return [
            JobStats::class,
        ];
    }
}
