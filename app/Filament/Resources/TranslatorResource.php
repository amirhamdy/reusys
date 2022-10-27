<?php

namespace App\Filament\Resources;

use App\Models\Translator;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\TranslatorResource\Pages;
use Filament\Forms\Components\Wizard;

class TranslatorResource extends Resource
{
    protected static ?string $model = Translator::class;

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $title = 'Resources';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';

    protected static ?string $navigationGroup = '   ';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Details')
                    ->schema([
                        Forms\Components\Section::make('Basic Details')
                            ->schema([
                                TextInput::make('name')
                                    ->rules(['required', 'max:255', 'string'])
                                    ->placeholder('Name')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('degree')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Degree')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                Select::make('gender')
                                    ->rules(['nullable', 'in:male,female,other'])
                                    ->searchable()
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                        'other' => 'Other',
                                    ])
                                    ->placeholder('Gender')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                DatePicker::make('date_of_birth')
                                    ->rules(['nullable', 'date'])
                                    ->placeholder('Date Of Birth')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('nationality')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Nationality')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('experience')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Experience')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('id_number')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Id Number')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('vat_number')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Vat Number')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('id_other')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Id Other')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('timezone')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Timezone')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('website')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Website')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('skype')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Skype')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),
                            ])
                    ]),
                Wizard\Step::make('Delivery')
                    ->schema([
                        Forms\Components\Section::make('More Details')
                            ->schema([
                                TextInput::make('native_language')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Native Language')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                TextInput::make('second_language')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Second Language')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                BelongsToSelect::make('translator_type_id')
                                    ->rules(['required', 'exists:translator_types,id'])
                                    ->relationship('translatorType', 'name')->preload()
                                    ->searchable()
                                    ->placeholder('Translator Type')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                BelongsToSelect::make('country_id')
                                    ->rules(['required', 'exists:countries,id'])
                                    ->relationship('country', 'name')->preload()
                                    ->searchable()
                                    ->placeholder('Country')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),

                                BelongsToSelect::make('currency_id')
                                    ->rules(['required', 'exists:currencies,id'])
                                    ->relationship('currency', 'name')->preload()
                                    ->searchable()
                                    ->placeholder('Currency')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 12,
                                    ]),
                            ]),
                    ]),
                Wizard\Step::make('Address')
                    ->schema([
                        TextInput::make('address')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Address')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 12,
                                'lg' => 12,
                            ]),

                        TextInput::make('city')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('City')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 12,
                                'lg' => 12,
                            ]),

                        TextInput::make('postal_code')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Postal Code')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 12,
                                'lg' => 12,
                            ]),

                        TextInput::make('payment_after')
                            ->rules(['required', 'max:255', 'string'])
                            ->placeholder('Payment After')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 12,
                                'lg' => 12,
                            ]),

                        Toggle::make('nda')
                            ->rules(['required', 'boolean'])
                            ->default('0')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 12,
                                'lg' => 12,
                            ]),

                        Toggle::make('cv')
                            ->rules(['required', 'boolean'])
                            ->default('0')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 12,
                                'lg' => 12,
                            ]),
                    ]),
            ]),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID')->toggleable(),
                Tables\Columns\TextColumn::make('name')->limit(50)->sortable()->searchable(),
                Tables\Columns\BooleanColumn::make('nda')->toggleable(),
                Tables\Columns\BooleanColumn::make('cv')->toggleable(),
                Tables\Columns\TextColumn::make('native_language')->limit(50)->toggleable(),
                Tables\Columns\TextColumn::make('second_language')->limit(50)->toggleable(),
                Tables\Columns\TextColumn::make('translatorType.name')->limit(50)->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('country.name')->limit(50)->toggleable(),
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

                MultiSelectFilter::make('translator_type_id')->relationship(
                    'translatorType',
                    'name'
                ),

                MultiSelectFilter::make('country_id')->relationship(
                    'country',
                    'name'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TranslatorResource\RelationManagers\TasksRelationManager::class,
            TranslatorResource\RelationManagers\TranslatorPriceListsRelationManager::class,
            TranslatorResource\RelationManagers\ContactsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTranslators::route('/'),
            'create' => Pages\CreateTranslator::route('/create'),
            'view' => Pages\ViewTranslator::route('/{record}'),
            'edit' => Pages\EditTranslator::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
