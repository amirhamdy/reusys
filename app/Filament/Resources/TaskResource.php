<?php

namespace App\Filament\Resources;

use App\Models\Task;
use Filament\{Forms\Components\Toggle, Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskResource\Pages;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = '   ';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('job_id')
                        ->rules(['required', 'exists:jobs,id'])
                        ->relationship('job', 'name')
                        ->searchable()
                        ->placeholder('Job')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DatePicker::make('start_date')
                        ->rules(['required', 'date'])
                        ->placeholder('Start Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DatePicker::make('delivery_date')
                        ->rules(['required', 'date'])
                        ->placeholder('Delivery Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('task_type_id')
                        ->rules(['required', 'exists:task_types,id'])
                        ->relationship('taskType', 'name')
                        ->searchable()
                        ->placeholder('Task Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('task_unit_id')
                        ->rules(['required', 'exists:task_units,id'])
                        ->relationship('taskUnit', 'name')
                        ->searchable()
                        ->placeholder('Task Unit')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('subject_matter_id')
                        ->rules(['required', 'exists:subject_matters,id'])
                        ->relationship('subjectMatter', 'name')
                        ->searchable()
                        ->placeholder('Subject Matter')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('translator_id')
                        ->label('Resource')
                        ->rules(['required', 'exists:translators,id'])
                        ->relationship('translator', 'name')
                        ->searchable()
                        ->placeholder('Resource')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('amount')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Amount')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    Select::make('is_paid')
                        ->label('Payment Status')
                        ->rules(['required', 'in:paid,not paid,waived cost'])
                        ->searchable()
                        ->options([
                            'Paid' => 'Paid',
                            'Not Paid' => 'Not paid',
                            'Waived Cost' => 'Waived cost',
                        ])
                        ->placeholder('Payment Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    Select::make('status')
                        ->rules([
                            'required',
                            'in:not started,in progress,completed',
                        ])
                        ->searchable()
                        ->options([
                            'Not Started' => 'Not started',
                            'In Progress' => 'In progress',
                            'Completed' => 'Completed',
                        ])
                        ->placeholder('Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    RichEditor::make('notes')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Notes')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(30)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('job.name')->limit(20)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('delivery_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('taskType.name')->limit(30)->sortable(),
                Tables\Columns\TextColumn::make('taskUnit.name')->limit(30)->sortable(),
                Tables\Columns\TextColumn::make('subjectMatter.name')->limit(30)->sortable(),
                Tables\Columns\TextColumn::make('translator.name')->limit(30)->label('Resource')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\BadgeColumn::make('is_paid')->enum([
                    'Paid' => 'Paid',
                    'Not Paid' => 'Not paid',
                    'Waived Cost' => 'Waived cost',
                ])->colors([
                    'success' => 'Paid',
                    'danger' => 'Not Paid',
                    'warning' => 'Waived Cost',
                ])->label('Payment Status')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'Not Started' => 'Not started',
                    'In Progress' => 'In progress',
                    'Completed' => 'Completed',
                ])->colors([
                    'danger' => 'Not Started',
                    'warning' => 'In Progress',
                    'success' => 'Completed',
                ])->searchable()->sortable(),
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

                MultiSelectFilter::make('job_id')->relationship('job', 'name'),

                MultiSelectFilter::make('task_type_id')->relationship(
                    'taskType',
                    'name'
                ),

                MultiSelectFilter::make('task_unit_id')->relationship(
                    'taskUnit',
                    'name'
                ),

                MultiSelectFilter::make('subject_matter_id')->relationship(
                    'subjectMatter',
                    'name'
                ),

                MultiSelectFilter::make('translator_id')->relationship(
                    'translator',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
