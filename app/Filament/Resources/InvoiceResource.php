<?php

namespace App\Filament\Resources;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use Filament\{Forms\Components\Repeater, Forms\Components\RichEditor, Forms\Components\Toggle, Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\InvoiceResource\Pages;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Invoices';

    protected static ?string $navigationLabel = 'All Invoices';

    protected static ?string $recordTitleAttribute = 'date';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Invoice Details')
                        ->schema([
                            Grid::make()->schema([
                                TextInput::make('number')
                                    ->rules(['max:255', 'string'])
                                    ->required()->disabled()
                                    ->default('REU6656-' . date('Ymd', strtotime(now())) . '-' . random_int(1000000, 99999999))
                                    ->placeholder('Number')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                                DatePicker::make('date')
                                    ->rules(['date'])
                                    ->required()
                                    ->default(now())
                                    ->placeholder('Date')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                                Select::make('bank_id')
                                    ->rules(['exists:banks,id'])
                                    ->required()
                                    ->relationship('bank', 'label')
                                    ->searchable()->preload()
                                    ->placeholder('Bank Account')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                                Toggle::make('paid')
                                    ->label('Invoice has been paid?')
                                    ->rules(['boolean'])
                                    ->required()
                                    ->default('0')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                                DatePicker::make('paid_date')
                                    ->rules(['date'])
                                    ->nullable()
                                    ->placeholder('Paid Date')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                                RichEditor::make('notes')
                                    ->rules(['max:255', 'string'])
                                    ->nullable()
                                    ->placeholder('Notes')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
                            ]),
                        ])
                ])
                ->columnSpan(1),

            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Invoice Jobs')
                        ->schema([
                            Grid::make()->schema([
                                Repeater::make('invoiceJobs')
                                    ->schema([
                                        Grid::make()->schema([
                                            Select::make('job_id')
                                                ->rules(['exists:jobs,id'])
                                                ->required()
                                                ->disableLabel()
                                                ->relationship('job', 'name')
                                                ->searchable()->preload()
                                                ->placeholder('Job')
                                                ->reactive()
                                                ->afterStateUpdated(function ($state, callable $set) {
                                                    $job = Job::find($state);
                                                    if ($job) {
                                                        $set('amount', $job->amount);
                                                        $set('cost', $job->cost);
                                                        $set('cost_usd', $job->cost_usd);
                                                    }
                                                })
                                                ->columnSpan(['default' => 1]),

                                            TextInput::make('amount')
//                                                ->hiddenOn(['view', 'edit'])
                                                ->disableLabel()->numeric()->required()->disabled()
                                                ->placeholder('Amount')
                                                ->columnSpan(['default' => 1]),
                                        ]),
                                        Grid::make()->schema([
                                            TextInput::make('cost')
//                                                ->hiddenOn(['view', 'edit'])
                                                ->disableLabel()->numeric()->required()->disabled()
                                                ->placeholder('Cost')
                                                ->columnSpan(['default' => 1]),

                                            TextInput::make('cost_usd')
//                                                ->hiddenOn(['view', 'edit'])
                                                ->disableLabel()->numeric()->required()->disabled()
                                                ->placeholder('Cost in USD')
                                                ->columnSpan(['default' => 1]),
                                        ]),

                                    ])
                                    ->relationship()
                                    ->label('')
                                    ->createItemButtonLabel('Attach another job')
                                    ->defaultItems(1)
                                    ->columnSpan('full'),
                            ])
                        ])
                ])
                ->columnSpan(2),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('number')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('date')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('bank.label')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\IconColumn::make('paid')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('paid_date')
                    ->toggleable()
                    ->date(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('bank_id')
                    ->relationship('bank', 'name')
                    ->indicator('Bank')
                    ->multiple()
                    ->label('Bank'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
//            InvoiceResource\RelationManagers\InvoiceJobsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
