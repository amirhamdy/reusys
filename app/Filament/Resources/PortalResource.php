<?php

namespace App\Filament\Resources;

use App\Models\Portal;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PortalResource\Pages;

class PortalResource extends Resource
{
    protected static ?string $model = Portal::class;

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = '    ';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    TextInput::make('url')
                        ->rules(['required', 'url'])
                        ->url()
                        ->placeholder('Url')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('username')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Username')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('password')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Password')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(30)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('url')->limit(30)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('username')->limit(30)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('password')->limit(30),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortals::route('/'),
            'create' => Pages\CreatePortal::route('/create'),
            'view' => Pages\ViewPortal::route('/{record}'),
            'edit' => Pages\EditPortal::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
