<?php

namespace App\Filament\Resources;

use App\Models\InvoiceJob;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\InvoiceJobResource\Pages;

class InvoiceJobResource extends Resource
{
    protected static ?string $model = InvoiceJob::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'id';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('amount')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Amount')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cost')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Cost')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cost_usd')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Cost Usd')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('invoice_id')
                        ->rules(['exists:invoices,id'])
                        ->required()
                        ->relationship('invoice', 'date')
                        ->searchable()
                        ->placeholder('Invoice')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('job_id')
                        ->rules(['exists:jobs,id'])
                        ->required()
                        ->relationship('job', 'name')
                        ->searchable()
                        ->placeholder('Job')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('cost')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('cost_usd')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('invoice.date')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('job.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('invoice_id')
                    ->relationship('invoice', 'date')
                    ->indicator('Invoice')
                    ->multiple()
                    ->label('Invoice'),

                SelectFilter::make('job_id')
                    ->relationship('job', 'name')
                    ->indicator('Job')
                    ->multiple()
                    ->label('Job'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoiceJobs::route('/'),
            'create' => Pages\CreateInvoiceJob::route('/create'),
            'view' => Pages\ViewInvoiceJob::route('/{record}'),
            'edit' => Pages\EditInvoiceJob::route('/{record}/edit'),
        ];
    }
}
