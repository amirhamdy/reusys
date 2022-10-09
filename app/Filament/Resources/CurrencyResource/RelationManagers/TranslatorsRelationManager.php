<?php

namespace App\Filament\Resources\CurrencyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class TranslatorsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'translators';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                BelongsToSelect::make('translator_type_id')
                    ->rules(['required', 'exists:translator_types,id'])
                    ->relationship('translatorType', 'name')
                    ->searchable()
                    ->placeholder('Translator Type')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('degree')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Degree')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('gender')
                    ->rules(['nullable', 'in:male,female,other'])
                    ->searchable()
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->placeholder('Gender')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                DatePicker::make('date_of_birth')
                    ->rules(['nullable', 'date'])
                    ->placeholder('Date Of Birth')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('nationality')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Nationality')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('experience')
                    ->rules(['nullable', 'numeric'])
                    ->numeric()
                    ->placeholder('Experience')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('id_number')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Id Number')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('id_other')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Id Other')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('vat_number')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Vat Number')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('timezone')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Timezone')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('website')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Website')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('skype')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Skype')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('address')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Address')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('city')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('City')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('postal_code')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Postal Code')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('payment_after')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Payment After')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Toggle::make('nda')
                    ->rules(['required', 'boolean'])
                    ->default('0')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Toggle::make('cv')
                    ->rules(['required', 'boolean'])
                    ->default('0')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('native_language_id')
                    ->rules(['nullable', 'exists:languages,id'])
                    ->relationship('nativeLanguage', 'name')
                    ->searchable()
                    ->placeholder('Native Language')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                BelongsToSelect::make('second_language_id')
                    ->rules(['nullable', 'exists:languages,id'])
                    ->relationship('secondLanguage', 'name')
                    ->searchable()
                    ->placeholder('Second Language')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                BelongsToSelect::make('country_id')
                    ->rules(['required', 'exists:countries,id'])
                    ->relationship('country', 'name')
                    ->searchable()
                    ->placeholder('Country')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translatorType.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('degree')->limit(50),
                Tables\Columns\TextColumn::make('gender')->enum([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ]),
                Tables\Columns\TextColumn::make('date_of_birth')->date(),
                Tables\Columns\TextColumn::make('nationality')->limit(50),
                Tables\Columns\TextColumn::make('experience'),
                Tables\Columns\TextColumn::make('id_number')->limit(50),
                Tables\Columns\TextColumn::make('id_other')->limit(50),
                Tables\Columns\TextColumn::make('vat_number')->limit(50),
                Tables\Columns\TextColumn::make('timezone')->limit(50),
                Tables\Columns\TextColumn::make('website')->limit(50),
                Tables\Columns\TextColumn::make('skype')->limit(50),
                Tables\Columns\TextColumn::make('address')->limit(50),
                Tables\Columns\TextColumn::make('city')->limit(50),
                Tables\Columns\TextColumn::make('postal_code')->limit(50),
                Tables\Columns\TextColumn::make('payment_after')->limit(50),
                Tables\Columns\BooleanColumn::make('nda'),
                Tables\Columns\BooleanColumn::make('cv'),
                Tables\Columns\TextColumn::make('nativeLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('secondLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('country.name')->limit(50),
                Tables\Columns\TextColumn::make('currency.name')->limit(50),
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

                MultiSelectFilter::make('translator_type_id')->relationship(
                    'translatorType',
                    'name'
                ),

                MultiSelectFilter::make('native_language_id')->relationship(
                    'nativeLanguage',
                    'name'
                ),

                MultiSelectFilter::make('second_language_id')->relationship(
                    'secondLanguage',
                    'name'
                ),

                MultiSelectFilter::make('country_id')->relationship(
                    'country',
                    'name'
                ),

                MultiSelectFilter::make('currency_id')->relationship(
                    'currency',
                    'name'
                ),
            ]);
    }
}
