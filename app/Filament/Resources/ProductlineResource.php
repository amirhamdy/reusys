<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductlineResource\Pages;
use App\Models\Productline;
use Filament\{Forms, Tables};
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductlineResource extends Resource
{
    protected static ?string $model = Productline::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-menu';

    protected static ?string $navigationLabel = 'Product Lines';

    protected static ?string $navigationGroup = 'Product Lines';

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

                    BelongsToSelect::make('pricebook_id')
                        ->rules(['required', 'exists:pricebooks,id'])->required()
                        ->relationship('pricebook', 'name')->preload()
                        ->searchable()
                        ->placeholder('Pricebook')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('customer_id')
                        ->rules(['required', 'exists:customers,id'])->required()
                        ->relationship('customer', 'name')->preload()
                        ->searchable()
                        ->placeholder('Customer')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('Product Line ID'),
                Tables\Columns\TextColumn::make('name')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('customer.name')->limit(50)->sortable()->searchable()->toggleable()->disableClick(),
                Tables\Columns\TextColumn::make('pricebook.name')->limit(50)->sortable()->searchable()->toggleable()->disableClick(),
                Tables\Columns\TextColumn::make('pricebook.currency.name')->limit(50)->sortable()->searchable()->toggleable()->disableClick(),
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
            'view' => Pages\ViewProductline::route('/{record}'),
            'edit' => Pages\EditProductline::route('/{record}/edit'),
        ];
    }

    //    protected static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }
}
