<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\Widgets\JobStats;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Pricelist;
use App\Models\Productline;
use App\Models\Project;
use Closure;
use Filament\{Forms, Notifications\Notification, Tables};
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Actions\Action;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Jobs';

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

                    BelongsToSelect::make('customer_id')
                        ->rules(['required', 'exists:customers,id'])
                        ->options(Customer::all()->pluck('name', 'id'))->preload()
                        ->searchable()->disablePlaceholderSelection()
                        ->placeholder('Customer')->label('Customer')
                        ->reactive()
                        ->afterStateUpdated(fn(callable $set) => $set('productline_id', null))
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('productline_id')
                        ->rules(['required', 'exists:productlines,id'])
                        ->options(function (callable $get) {
                            $customer = Customer::find($get('customer_id'));
                            if ($customer) return $customer->productlines->pluck('name', 'id');
                            return [];
                        })->preload()
                        ->searchable()->reactive()
                        ->placeholder('Productline')->label('Productline')
                        ->afterStateUpdated(fn(callable $set) => $set('project_id', null))
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('project_id')
                        ->rules(['required', 'exists:projects,id'])
                        ->options(function (callable $get) {
                            $select = Productline::find($get('productline_id'));
                            if ($select) return $select->projects->pluck('name', 'id');
                            return [];
                        })->preload()
                        ->searchable()->reactive()
                        ->placeholder('Project')->label('Project')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    BelongsToSelect::make('source_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('sourceLanguage', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Source Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    BelongsToSelect::make('target_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('targetLanguage', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Target Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    BelongsToSelect::make('job_type_id')
                        ->rules(['required', 'exists:job_types,id'])
                        ->relationship('jobType', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Job Type')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    BelongsToSelect::make('job_unit_id')
                        ->rules(['required', 'exists:job_units,id'])
                        ->relationship('jobUnit', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Job Unit')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    TextInput::make('amount')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Amount')
                        ->default(1)
                        ->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    TextInput::make('cost')
                        ->hint('This is a calculated not editable cost depending on your selections.')
                        ->rules(['required', 'numeric'])
                        ->numeric()->disabled()
                        ->placeholder('This is a calculated not editable cost depending on your selections')
                        ->default(null)
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    Toggle::make('is_free_job')
                        ->label('Mark as a free job')
                        ->rules(['required', 'boolean'])
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->reactive()
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    Toggle::make('is_minimum_charge_used')
                        ->label('Apply minimum charge for this job')
                        ->rules(['required', 'boolean'])
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->reactive()
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),
                ]),
            ]),
        ])->columns(3);
    }

    public static function calc_cost(Closure $set, Closure $get)
    {
        $is_free_job = $get('is_free_job');
        $project_id = $get('project_id') ?? 0;
        $job_type_id = $get('job_type_id') ?? 0;
        $job_unit_id = $get('job_unit_id') ?? 0;
        $source_language_id = $get('source_language_id') ?? 0;
        $target_language_id = $get('target_language_id') ?? 0;
        $is_minimum_charge_used = $get('is_minimum_charge_used');
        $amount = (int)$get('amount') ?? 0;

        if ($project_id && $job_type_id && $job_unit_id && $source_language_id && $target_language_id) {
            if ($is_free_job) {
                $cost = 0;
                $set('is_minimum_charge_used', false);
            } else {
                $project = Project::where('id', $project_id)->first();

                if (!$project) {
                    Notification::make()->warning()->title('Invalid project selected!')->body('Please select a valid project to continue.')->send();
                }

                $productline = Productline::where('id', $project->productline_id)->first();

                if (!$productline) {
                    Notification::make()
                        ->warning()
                        ->title('No productline found for the selected project!')
                        ->body('Please check the selected project and make sure it has a valid productline to continue.')
                        ->send();
                }

                $pricelist = Pricelist::where('job_type_id', $job_type_id)
                    ->where('job_unit_id', $job_unit_id)
                    ->where('source_language_id', $source_language_id)
                    ->where('target_language_id', $target_language_id)
                    ->where('pricebook_id', $productline->pricebook_id)
                    ->first();

                if ($pricelist && isset($pricelist['unit_price'])) {
                    if ($is_minimum_charge_used) {
                        $cost = $pricelist['minimum_charge'];
                        $set('is_free_job', false);
                    } else {
                        $unit_price = $pricelist['unit_price'];
                        $cost = $amount * $unit_price;
                    }
                } else {
                    $cost = null;
                    Notification::make()
                        ->warning()
                        ->title('No pricelist found!')
                        ->body('Please check the selected productline and make sure it has a valid pricelist to continue.')
                        ->actions([
                            Action::make('Open pricebook page')
                                ->button()
                                ->url("/dashboard/pricebooks/$productline->pricebook_id", shouldOpenInNewTab: true)
                        ])
                        ->send();
                }
            }
        }

        $set('cost', $cost ?? null);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID')->toggleable(),
                Tables\Columns\TextColumn::make('name')->limit(30)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('project.name')->limit(30)->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('sourceLanguage.name')->limit(20)->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('targetLanguage.name')->limit(20)->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('jobType.name')->limit(30)->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('jobUnit.name')->limit(30)->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('amount')->toggleable(),
                Tables\Columns\BooleanColumn::make('is_free_job')->toggleable(),
                Tables\Columns\BooleanColumn::make('is_minimum_charge_used')->toggleable(),
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
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }

    //    protected static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }

    public static function getWidgets(): array
    {
        return [
            JobStats::class,
        ];
    }
}
