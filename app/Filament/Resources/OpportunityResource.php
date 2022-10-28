<?php

namespace App\Filament\Resources;

use App\Models\Opportunity;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\OpportunityResource\Pages;

class OpportunityResource extends Resource
{
    protected static ?string $model = Opportunity::class;

    protected static ?int $navigationSort = 8;

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

                    DatePicker::make('date')
                        ->rules(['required', 'date'])
                        ->placeholder('Date')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    TextInput::make('probability_to_win')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Probability To Win')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    TextInput::make('amount')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Amount')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('price')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Price')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('status')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Status')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('source_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('sourceLanguage', 'name')
                        ->searchable()
                        ->placeholder('Source Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('target_language_id')
                        ->rules(['required', 'exists:languages,id'])
                        ->relationship('targetLanguage', 'name')
                        ->searchable()
                        ->placeholder('Target Language')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('productline_id')
                        ->rules(['required', 'exists:productlines,id'])
                        ->relationship('productline', 'name')
                        ->searchable()
                        ->placeholder('Productline')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('opportunity_type_id')
                        ->rules(['required', 'exists:opportunity_types,id'])
                        ->relationship('opportunityType', 'name')
                        ->searchable()
                        ->placeholder('Opportunity Type')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('opportunity_unit_id')
                        ->rules(['required', 'exists:opportunity_units,id'])
                        ->relationship('opportunityUnit', 'name')
                        ->searchable()
                        ->placeholder('Opportunity Unit')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    RichEditor::make('description')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Description')
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
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('probability_to_win')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('status')->limit(50),
                Tables\Columns\TextColumn::make('sourceLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('targetLanguage.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('productline.name')->limit(50),
                Tables\Columns\TextColumn::make('opportunityType.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('opportunityUnit.name')->limit(
                    50
                ),
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

                MultiSelectFilter::make('source_language_id')->relationship(
                    'sourceLanguage',
                    'name'
                ),

                MultiSelectFilter::make('target_language_id')->relationship(
                    'targetLanguage',
                    'name'
                ),

                MultiSelectFilter::make('productline_id')->relationship(
                    'productline',
                    'name'
                ),

                MultiSelectFilter::make('opportunity_type_id')->relationship(
                    'opportunityType',
                    'name'
                ),

                MultiSelectFilter::make('opportunity_unit_id')->relationship(
                    'opportunityUnit',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOpportunities::route('/'),
            'create' => Pages\CreateOpportunity::route('/create'),
            'view' => Pages\ViewOpportunity::route('/{record}'),
            'edit' => Pages\EditOpportunity::route('/{record}/edit'),
        ];
    }
}
