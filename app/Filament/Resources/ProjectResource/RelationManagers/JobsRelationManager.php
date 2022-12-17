<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\Pricelist;
use App\Models\Productline;
use App\Models\Project;
use Closure;
use Filament\Forms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Livewire\Component as Livewire;

class JobsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'jobs';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    BelongsToSelect::make('source_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('sourceLanguage', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Source Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),

                    BelongsToSelect::make('target_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('targetLanguage', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Target Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),

                    BelongsToSelect::make('job_type_id')
                        ->rules(['required', 'exists:job_types,id'])
                        ->relationship('jobType', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Job Type')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),

                    BelongsToSelect::make('job_unit_id')
                        ->rules(['required', 'exists:job_units,id'])
                        ->relationship('jobUnit', 'name')->preload()
                        ->searchable()->reactive()
                        ->placeholder('Job Unit')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),

                    TextInput::make('amount')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Amount')
                        ->default(1)
                        ->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),

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
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),

                    Toggle::make('is_minimum_charge_used')
                        ->label('Apply minimum charge for this job')
                        ->rules(['required', 'boolean'])
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6])
                        ->reactive()
                        ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire)),
                ]),
        ]);
    }

    public static function calc_cost(Closure $set, Closure $get, Livewire $livewire)
    {
        $is_free_job = $get('is_free_job');
        $project_id = $livewire->ownerRecord->id ?? 0;
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
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('project.name')->limit(50),
                Tables\Columns\TextColumn::make('sourceLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('targetLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('jobType.name')->limit(50),
                Tables\Columns\TextColumn::make('jobUnit.name')->limit(50),
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
}
