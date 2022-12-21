<?php

namespace App\Filament\Resources\TranslatorResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\{Form, Table};
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Tables;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class TranslatorPriceListsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'translatorPriceLists';

    protected static ?string $recordTitleAttribute = 'id';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                BelongsToSelect::make('task_type_id')
                    ->rules(['required', 'exists:task_types,id'])->required()
                    ->relationship('taskType', 'name')
                    ->searchable()->preload()
                    ->placeholder('Task Type')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

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

                BelongsToSelect::make('subject_matter_id')
                    ->rules(['required', 'exists:subject_matters,id'])->required()
                    ->relationship('subjectMatter', 'name')
                    ->searchable()->preload()
                    ->placeholder('Subject Matter')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                BelongsToSelect::make('currency_id')
                    ->rules(['required', 'exists:currencies,id'])->required()
                    ->relationship('currency', 'name')
                    ->searchable()->preload()
                    ->placeholder('Currency')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                BelongsToSelect::make('task_unit_id')
                    ->rules(['required', 'exists:task_units,id'])->required()
                    ->relationship('taskUnit', 'name')
                    ->searchable()->preload()
                    ->placeholder('Task Unit')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                TextInput::make('unit_price')
                    ->rules(['required', 'numeric'])->required()
                    ->numeric()
                    ->placeholder('Unit Price')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                TextInput::make('minimum_charge')
                    ->rules(['required', 'numeric'])->required()
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
                Tables\Columns\TextColumn::make('taskType.name')->limit(50),
                Tables\Columns\TextColumn::make('sourceLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('targetLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('subjectMatter.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('currency.name')->limit(50),
                Tables\Columns\TextColumn::make('taskUnit.name')->limit(50),
                Tables\Columns\TextColumn::make('translator.name')->limit(50),
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

                MultiSelectFilter::make('task_type_id')->relationship(
                    'taskType',
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

                MultiSelectFilter::make('subject_matter_id')->relationship(
                    'subjectMatter',
                    'name'
                ),

                MultiSelectFilter::make('currency_id')->relationship(
                    'currency',
                    'name'
                ),

                MultiSelectFilter::make('task_unit_id')->relationship(
                    'taskUnit',
                    'name'
                ),

                MultiSelectFilter::make('translator_id')->relationship(
                    'translator',
                    'name'
                ),
            ]);
    }
}
