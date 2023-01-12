<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Customer;
use App\Models\Project;
use Filament\{Forms, Tables};
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationGroup = 'Projects';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Project Details')
                            ->schema([
                                Grid::make()->schema([
                                    TextInput::make('name')
                                        ->rules(['required', 'max:255', 'string'])
                                        ->placeholder('Name')->required()
                                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                                    BelongsToSelect::make('customer_id')
                                        ->rules(['required', 'exists:customers,id'])->required()
                                        ->hiddenOn(['edit'])
                                        ->options(Customer::all()->where('customer_status_id', '3')->pluck('name', 'id'))->preload()
                                        ->searchable()->disablePlaceholderSelection()
                                        ->placeholder('Customer')->label('Customer')
                                        ->reactive()
                                        ->afterStateUpdated(fn(callable $set) => $set('productline_id', null))
                                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                                    BelongsToSelect::make('productline_id')
                                        ->rules(['required', 'exists:productlines,id'])->required()
                                        ->hiddenOn(['edit'])
                                        ->options(function (callable $get) {
                                            $customer = Customer::find($get('customer_id'));
                                            if ($customer) return $customer->productlines->pluck('name', 'id');
                                            return [];
                                        })->preload()
                                        ->searchable()
                                        ->placeholder('Productline')->label('Productline')
                                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                                    DatePicker::make('start_date')
                                        ->rules(['required', 'date'])->required()
                                        ->beforeOrEqual('end_date')
                                        ->placeholder('Start Date')
                                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                                    DatePicker::make('end_date')
                                        ->rules(['required', 'date'])->required()
                                        ->afterOrEqual('start_date')
                                        ->placeholder('End Date')
                                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                                    TextInput::make('po_number')
                                        ->rules(['required', 'max:255', 'string'])->required()
                                        ->placeholder('Po Number')
                                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),
                                ]),
                            ]),
                    ])
                    ->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Profit in USD')
                            ->schema([
                                Forms\Components\TextInput::make('profit')->label('')
                            ])
                            ->hiddenOn(['edit']),

//                        Forms\Components\Card::make()
//                            ->schema([
//                                Forms\Components\Placeholder::make('created_at')
//                                    ->label('Created at')
//                                    ->content(fn(Project $record): ?string => $record->created_at?->diffForHumans()),
//
//                                Forms\Components\Placeholder::make('updated_at')
//                                    ->label('Last modified at')
//                                    ->content(fn(Project $record): ?string => $record->updated_at?->diffForHumans()),
//                            ])
//                            ->hiddenOn(['edit']),
                    ])
                    ->hidden(fn(?Project $record) => $record === null)
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID')->toggleable(),
                Tables\Columns\TextColumn::make('name')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('start_date')->date()->toggleable(),
                Tables\Columns\TextColumn::make('end_date')->date()->toggleable(),
                Tables\Columns\TextColumn::make('productline.name')->limit(50)->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('po_number')->limit(50)->toggleable(),
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

                MultiSelectFilter::make('productline_id')->relationship(
                    'productline',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [ProjectResource\RelationManagers\JobsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    //    protected static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }
}
