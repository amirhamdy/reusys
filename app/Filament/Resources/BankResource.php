<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'System Settings';

    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('label')
                        ->rules(['max:255', 'string'])
                        ->placeholder('Label')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('account_number')
                        ->rules(['max:255', 'string'])
                        ->placeholder('Account Number')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('account_name')
                        ->rules(['max:255', 'string'])
                        ->placeholder('Account Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('routing_number')
                        ->rules(['max:255', 'string'])
                        ->placeholder('Routing Number')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    BelongsToSelect::make('country_id')
                        ->rules(['required', 'exists:countries,id'])->required()
                        ->relationship('country', 'name')->preload()
                        ->searchable()
                        ->placeholder('Country')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('label')->limit(50),
                Tables\Columns\TextColumn::make('account_number')->limit(50),
                Tables\Columns\TextColumn::make('account_name')->limit(50),
                Tables\Columns\TextColumn::make('routing_number')->limit(50),
//                Tables\Columns\TextColumn::make('country.name')->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('n')
                    ->form([
                        Forms\Components\TextInput::make('name'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['name'] ?? null,
                                fn(Builder $query, string $name) => $query->where('name', 'like', "%{$name}%")
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBanks::route('/'),
        ];
    }
}
