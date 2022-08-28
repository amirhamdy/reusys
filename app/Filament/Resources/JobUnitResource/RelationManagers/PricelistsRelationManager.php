<?php

namespace App\Filament\Resources\JobUnitResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

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
                    ->rules(['required', 'exists:subject_matters,id'])
                    ->relationship('subjectMatter', 'name')
                    ->searchable()
                    ->placeholder('Subject Matter')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('job_type_id')
                    ->rules(['required', 'exists:job_types,id'])
                    ->relationship('jobType', 'name')
                    ->searchable()
                    ->placeholder('Job Type')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('source_language_id')
                    ->rules(['required', 'exists:languages,id'])
                    ->relationship('sourceLanguage', 'name')
                    ->searchable()
                    ->placeholder('Source Language')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('target_language_id')
                    ->rules(['required', 'exists:languages,id'])
                    ->relationship('targetLanguage', 'name')
                    ->searchable()
                    ->placeholder('Target Language')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('pricebook_id')
                    ->rules(['required', 'exists:pricebooks,id'])
                    ->relationship('pricebook', 'name')
                    ->searchable()
                    ->placeholder('Pricebook')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('unit_price')
                    ->rules(['required', 'numeric'])
                    ->numeric()
                    ->placeholder('Unit Price')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('minimum_charge')
                    ->rules(['nullable', 'numeric'])
                    ->numeric()
                    ->placeholder('Minimum Charge')
                    ->default('0')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
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
