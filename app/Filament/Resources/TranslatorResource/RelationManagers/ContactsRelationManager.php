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
use Filament\Resources\RelationManagers\HasManyRelationManager;

class ContactsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'contacts';

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                TextInput::make('phone')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Phone')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                TextInput::make('email')
                    ->rules(['required', 'email'])
                    ->email()
                    ->placeholder('Email')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                TextInput::make('position')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Position')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
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
                Tables\Columns\TextColumn::make('position')->limit(50),
                Tables\Columns\TextColumn::make('translator.name')->limit(50),
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

                MultiSelectFilter::make('translator_id')->relationship(
                    'translator',
                    'name'
                ),
            ]);
    }
}
