<?php

namespace App\Filament\Resources\ProductlineResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class ProjectsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'projects';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])->required()
                    ->placeholder('Name')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                DatePicker::make('start_date')
                    ->rules(['required', 'date'])->required()
                    ->placeholder('Start Date')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                DatePicker::make('end_date')
                    ->rules(['required', 'date'])->required()
                    ->placeholder('End Date')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                TextInput::make('po_number')
                    ->rules(['required', 'max:255', 'string'])->required()
                    ->placeholder('Po Number')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('end_date')->date(),
                Tables\Columns\TextColumn::make('productline.name')->limit(50),
                Tables\Columns\TextColumn::make('po_number')->limit(50),
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

                MultiSelectFilter::make('productline_id')->relationship(
                    'productline',
                    'name'
                ),
            ]);
    }
}
