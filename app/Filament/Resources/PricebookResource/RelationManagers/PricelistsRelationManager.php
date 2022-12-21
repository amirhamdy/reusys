<?php

namespace App\Filament\Resources\PricebookResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\{Form, Table};
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Tables;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class PricelistsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'pricelists';

    protected static ?string $recordTitleAttribute = 'id';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                BelongsToSelect::make('subject_matter_id')
                    ->rules(['required', 'exists:subject_matters,id'])->required()
                    ->relationship('subjectMatter', 'name')
                    ->searchable()->preload()
                    ->placeholder('Subject Matter')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                BelongsToSelect::make('job_type_id')
                    ->rules(['required', 'exists:job_types,id'])->required()
                    ->relationship('jobType', 'name')
                    ->searchable()->preload()
                    ->placeholder('Job Type')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('job_unit_id')
                    ->rules(['required', 'exists:job_units,id'])->required()
                    ->relationship('jobUnit', 'name')
                    ->searchable()->preload()
                    ->placeholder('Job Unit')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('source_language_id')
                    ->rules(['required', 'exists:languages,id'])->required()
                    ->relationship('sourceLanguage', 'name')
                    ->searchable()->preload()
                    ->placeholder('Source Language')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('target_language_id')
                    ->rules(['required', 'exists:languages,id'])->required()
                    ->relationship('targetLanguage', 'name')
                    ->searchable()->preload()
                    ->placeholder('Target Language')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                TextInput::make('unit_price')
                    ->rules(['required', 'numeric'])->required()
                    ->numeric()
                    ->placeholder('Unit Price')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                TextInput::make('minimum_charge')
                    ->rules(['nullable', 'numeric'])
                    ->numeric()
                    ->placeholder('Minimum Charge')
                    ->default('0')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subjectMatter.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('jobType.name')->limit(50),
                Tables\Columns\TextColumn::make('jobUnit.name')->limit(50),
                Tables\Columns\TextColumn::make('sourceLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('targetLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('pricebook.name')->limit(50),
                Tables\Columns\TextColumn::make('unit_price'),
                Tables\Columns\TextColumn::make('minimum_charge'),
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

                MultiSelectFilter::make('subject_matter_id')->relationship(
                    'subjectMatter',
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

                MultiSelectFilter::make('source_language_id')->relationship(
                    'sourceLanguage',
                    'name'
                ),

                MultiSelectFilter::make('target_language_id')->relationship(
                    'targetLanguage',
                    'name'
                ),

                MultiSelectFilter::make('pricebook_id')->relationship(
                    'pricebook',
                    'name'
                ),
            ]);
    }
}
