<?php

namespace App\Filament\Resources;

use App\Models\Productline;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\ProductlineResource\Pages;

class ProductlineResource extends Resource
{
    protected static ?string $model = Productline::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('customer_id')
                        ->rules(['required', 'exists:customers,id'])
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->placeholder('Customer')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('pricebook.name')->limit(50),
                Tables\Columns\TextColumn::make('customer.name')->limit(50),
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

                MultiSelectFilter::make('pricebook_id')->relationship(
                    'pricebook',
                    'name'
                ),

                MultiSelectFilter::make('customer_id')->relationship(
                    'customer',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductlineResource\RelationManagers\ProjectsRelationManager::class,
            ProductlineResource\RelationManagers\OpportunitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductlines::route('/'),
            'create' => Pages\CreateProductline::route('/create'),
            'edit' => Pages\EditProductline::route('/{record}/edit'),
        ];
    }
}
