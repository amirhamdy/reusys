<?php

namespace App\Filament\Resources\TranslatorResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class EmailsRelationManager extends RelationManager
{
    protected static string $relationship = 'emails';

    protected static ?string $recordTitleAttribute = 'address';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('address')
                    ->rules(['max:255', 'string'])
                    ->required()
                    ->placeholder('Email Address')
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
                Tables\Columns\TextColumn::make('address')->limit(50)->copyable(),
//                Tables\Columns\TextColumn::make('translator.id')->limit(50),
            ])
//            ->filters([
//                Tables\Filters\Filter::make('created_at')
//                    ->form([
//                        Forms\Components\DatePicker::make('created_from'),
//                        Forms\Components\DatePicker::make('created_until'),
//                    ])
//                    ->query(function (Builder $query, array $data): Builder {
//                        return $query
//                            ->when(
//                                $data['created_from'],
//                                fn(
//                                    Builder $query,
//                                    $date
//                                ): Builder => $query->whereDate(
//                                    'created_at',
//                                    '>=',
//                                    $date
//                                )
//                            )
//                            ->when(
//                                $data['created_until'],
//                                fn(
//                                    Builder $query,
//                                    $date
//                                ): Builder => $query->whereDate(
//                                    'created_at',
//                                    '<=',
//                                    $date
//                                )
//                            );
//                    }),
//
//                MultiSelectFilter::make('translator_id')->relationship(
//                    'translator',
//                    'id'
//                ),
//            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
