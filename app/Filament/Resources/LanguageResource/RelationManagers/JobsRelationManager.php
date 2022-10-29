<?php

namespace App\Filament\Resources\LanguageResource\RelationManagers;

use Filament\Forms;
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

                BelongsToSelect::make('project_id')
                    ->rules(['required', 'exists:projects,id'])
                    ->relationship('project', 'name')
                    ->searchable()
                    ->placeholder('Project')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                BelongsToSelect::make('source_language_id')
                    ->rules(['required', 'exists:languages,id'])
                    ->relationship('sourceLanguage', 'name')
                    ->searchable()
                    ->placeholder('Source Language')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('job_type_id')
                    ->rules(['required', 'exists:job_types,id'])
                    ->relationship('jobType', 'name')
                    ->searchable()
                    ->placeholder('Job Type')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('job_unit_id')
                    ->rules(['required', 'exists:job_units,id'])
                    ->relationship('jobUnit', 'name')
                    ->searchable()
                    ->placeholder('Job Unit')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                TextInput::make('amount')
                    ->rules(['required', 'numeric'])
                    ->numeric()
                    ->placeholder('Amount')
                    ->default('1')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                Toggle::make('is_free_job')
                    ->rules(['required', 'boolean'])
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                Toggle::make('is_minimum_charge_used')
                    ->rules(['required', 'boolean'])
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
            ]),
        ]);
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
