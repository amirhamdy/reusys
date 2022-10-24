<?php

namespace App\Filament\Resources;

use App\Models\Customer;
use App\Models\Productline;
use App\Models\Project;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\ProjectResource\Pages;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = '  ';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    BelongsToSelect::make('customer_id')
                        ->rules(['required', 'exists:customers,id'])
                        ->options(Customer::all()->pluck('name', 'id'))->preload()
                        ->searchable()->disablePlaceholderSelection()
                        ->placeholder('Customer')->label('Customer')
                        ->reactive()
                        ->afterStateUpdated(fn(callable $set) => $set('productline_id', null))
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    BelongsToSelect::make('productline_id')
                        ->rules(['required', 'exists:productlines,id'])
                        ->options(function (callable $get) {
                            $customer = Customer::find($get('customer_id'));

                            if ($customer) {
                                return $customer->productlines->pluck('name', 'id');
                            }

                            return [];
                        })->preload()
                        ->searchable()
                        ->placeholder('Productline')->label('Productline')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DatePicker::make('start_date')
                        ->rules(['required', 'date'])
                        ->placeholder('Start Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    DatePicker::make('end_date')
                        ->rules(['required', 'date'])
                        ->placeholder('End Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('po_number')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Po Number')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),
                ]),
            ]),
        ]);
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

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
