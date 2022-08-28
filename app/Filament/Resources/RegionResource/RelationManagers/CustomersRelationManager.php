<?php

namespace App\Filament\Resources\RegionResource\RelationManagers;

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

class CustomersRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'customers';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('phone')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Phone')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('email')
                    ->rules(['required', 'email'])
                    ->email()
                    ->placeholder('Email')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('fax')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Fax')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('address')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Address')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('billing_address')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Billing Address')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('postal_code')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Postal Code')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('website')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Website')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('city')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('City')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                BelongsToSelect::make('customer_status_id')
                    ->rules(['required', 'exists:customer_statuses,id'])
                    ->relationship('customerStatus', 'name')
                    ->searchable()
                    ->placeholder('Customer Status')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                BelongsToSelect::make('country_id')
                    ->rules(['required', 'exists:countries,id'])
                    ->relationship('country', 'name')
                    ->searchable()
                    ->placeholder('Country')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                BelongsToSelect::make('customer_rating_id')
                    ->rules(['required', 'exists:customer_ratings,id'])
                    ->relationship('customerRating', 'name')
                    ->searchable()
                    ->placeholder('Customer Rating')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                BelongsToSelect::make('industry_id')
                    ->rules(['required', 'exists:industries,id'])
                    ->relationship('industry', 'name')
                    ->searchable()
                    ->placeholder('Industry')
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
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('phone')->limit(50),
                Tables\Columns\TextColumn::make('email')->limit(50),
                Tables\Columns\TextColumn::make('fax')->limit(50),
                Tables\Columns\TextColumn::make('address')->limit(50),
                Tables\Columns\TextColumn::make('billing_address')->limit(50),
                Tables\Columns\TextColumn::make('postal_code')->limit(50),
                Tables\Columns\TextColumn::make('website')->limit(50),
                Tables\Columns\TextColumn::make('city')->limit(50),
                Tables\Columns\TextColumn::make('customerStatus.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('country.name')->limit(50),
                Tables\Columns\TextColumn::make('region.name')->limit(50),
                Tables\Columns\TextColumn::make('customerRating.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('industry.name')->limit(50),
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

                MultiSelectFilter::make('customer_status_id')->relationship(
                    'customerStatus',
                    'name'
                ),

                MultiSelectFilter::make('country_id')->relationship(
                    'country',
                    'name'
                ),

                MultiSelectFilter::make('region_id')->relationship(
                    'region',
                    'name'
                ),

                MultiSelectFilter::make('customer_rating_id')->relationship(
                    'customerRating',
                    'name'
                ),

                MultiSelectFilter::make('industry_id')->relationship(
                    'industry',
                    'name'
                ),
            ]);
    }
}
