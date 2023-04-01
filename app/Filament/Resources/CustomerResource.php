<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\{Forms, Tables};
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationLabel = 'All Customers';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])->required()
                        ->placeholder('Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('phone')
                        ->rules(['required', 'max:255', 'string'])->required()
                        ->placeholder('Phone')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('email')
                        ->rules(['required', 'email'])->required()
                        ->email()
                        ->placeholder('Email')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('fax')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Fax')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('address')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Address')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    TextInput::make('billing_address')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Billing Address')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    TextInput::make('postal_code')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Postal Code')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('website')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Website')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('city')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('City')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('customer_status_id')
                        ->rules(['required', 'exists:customer_statuses,id'])->required()
                        ->relationship('customerStatus', 'name')->preload()
                        ->searchable()
                        ->placeholder('Customer Status')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('country_id')
                        ->rules(['required', 'exists:countries,id'])->required()
                        ->relationship('country', 'name')->preload()
                        ->searchable()
                        ->placeholder('Country')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('region_id')
                        ->rules(['required', 'exists:regions,id'])->required()
                        ->relationship('region', 'name')->preload()
                        ->searchable()
                        ->placeholder('Region')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('customer_rating_id')
                        ->rules(['required', 'exists:customer_ratings,id'])->required()
                        ->relationship('customerRating', 'name')->preload()
                        ->searchable()
                        ->placeholder('Customer Rating')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('industry_id')
                        ->rules(['required', 'exists:industries,id'])->required()
                        ->relationship('industry', 'name')->preload()
                        ->searchable()
                        ->placeholder('Industry')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID')->toggleable(),
                Tables\Columns\TextColumn::make('name')->limit(30)->sortable()->searchable()->copyable(),
                Tables\Columns\TextColumn::make('email')->limit(50)->sortable()->searchable()->toggleable()->copyable(),
                Tables\Columns\TextColumn::make('customerStatus.name')->limit(20)->label('Status')->toggleable()->copyable(),
                Tables\Columns\TextColumn::make('country.name')->limit(20)->sortable()->searchable()->toggleable()->copyable(),
                Tables\Columns\TextColumn::make('region.name')->limit(20)->sortable()->searchable()->toggleable()->copyable(),
                Tables\Columns\TextColumn::make('customerRating.name')->limit(20)->sortable()->label('Rating')->toggleable()->copyable(),
                Tables\Columns\TextColumn::make('industry.name')->limit(20)->sortable()->searchable()->toggleable()->copyable(),
            ])->defaultSort('id', 'desc')
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

    public static function getRelations(): array
    {
        return [
            CustomerResource\RelationManagers\ProductlinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    //    protected static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }

}
