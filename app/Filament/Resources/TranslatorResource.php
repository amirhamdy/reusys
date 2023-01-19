<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslatorResource\Pages;
use App\Models\Translator;
use Closure;
use Filament\{Forms, Tables};
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;

class TranslatorResource extends Resource
{
    protected static ?string $model = Translator::class;

    protected static ?string $modelLabel = 'Resource';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $title = 'Resources';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                static::getFirstStep(),
                static::getSecondStep(),
                static::getThirdStep(),
                static::getForthStep(),
            ]),
        ])->columns(1);
    }

    public static function getFirstStep(): Step
    {
        return Step::make('Resource Type')
            ->schema([
                Section::make('Select Resource Type')
                    ->schema([
                        BelongsToSelect::make('translator_type_id')
                            ->rules(['required', 'exists:translator_types,id'])->required()
                            ->relationship('translatorType', 'name')->preload()
                            ->searchable()->disableLabel()->reactive()
                            ->placeholder('Resource Type')
                            ->columnSpan(['default' => 1, 'md' => 1, 'lg' => 1]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getSecondStep(): Step
    {
        return Step::make('Resource Details')
            ->schema([
                Section::make('Basic Details')
                    ->schema([
                        TextInput::make('name')
                            ->rules(['required', 'max:255', 'string'])->required()
                            ->placeholder('Name')
                            ->columnSpan(['default' => 1, 'md' => 1, 'lg' => 6]),
                        TextInput::make('degree')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Degree')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        Select::make('gender')
                            ->rules(['nullable', 'in:male,female,other'])
                            ->searchable()
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->placeholder('Gender')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        DatePicker::make('date_of_birth')
                            ->rules(['nullable', 'date'])
                            ->placeholder('Date Of Birth')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('nationality')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Nationality')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('experience')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->label('Experience as Translator')
                            ->placeholder('Experience as Translator')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('native_language')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Native Language')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('second_language')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Second Language')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 2)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('id_number')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('ID Number')->label('ID Number')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 1)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('vat_number')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Vat Number')->label('Vat Number')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 1)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('id_other')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('ID Other')->label('ID Other')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 1)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('timezone')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Timezone')
                            ->hidden(fn(Closure $get) => $get('translator_type_id') == 1)
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                    ])->columns(12)
            ]);
    }

    public static function getThirdStep(): Step
    {
        return Step::make('Contact Details')
            ->schema([
                Section::make('Contact Details')
                    ->schema([
                        TextInput::make('website')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Website')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('skype')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Skype')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        BelongsToSelect::make('country_id')
                            ->rules(['required', 'exists:countries,id'])->required()
                            ->relationship('country', 'name')->preload()
                            ->searchable()
                            ->placeholder('Country')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        BelongsToSelect::make('currency_id')
                            ->rules(['required', 'exists:currencies,id'])->required()
                            ->relationship('currency', 'name')->preload()
                            ->searchable()
                            ->placeholder('Currency')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),])->columns(12),
            ]);
    }

    public static function getForthStep(): Step
    {
        return Step::make('Address Details')
            ->schema([
                Section::make('Address Details')
                    ->schema([
                        TextInput::make('address')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Address')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('city')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('City')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('postal_code')
                            ->rules(['nullable', 'max:255', 'string'])
                            ->placeholder('Postal Code')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        TextInput::make('payment_after')
                            ->rules(['required', 'max:255', 'string'])->required()
                            ->placeholder('Payment After')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        Toggle::make('nda')
                            ->rules(['required', 'boolean'])->required()
                            ->default('0')
                            ->columnSpan(['default' => 6, 'md' => 6, 'lg' => 6]),
                        Toggle::make('cv')
                            ->rules(['required', 'boolean'])->required()
                            ->default('0')
                            ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),])->columns(12),
            ]);
    }

    /*    public static function getNameFormField(): Forms\Components\TextInput
    {
        return TextInput::make('name')
            ->required()
            ->reactive()
            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)));
    }

    public static function getSlugFormField(): Forms\Components\TextInput
    {
        return TextInput::make('slug')
            ->disabled()
            ->required()
            ->unique(Category::class, 'slug', fn($record) => $record);
    }*/

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID')->toggleable(),
                Tables\Columns\TextColumn::make('name')->limit(50)->sortable()->searchable(true, null, true),
                Tables\Columns\BooleanColumn::make('nda')->toggleable(),
                Tables\Columns\BooleanColumn::make('cv')->toggleable(),
                Tables\Columns\TextColumn::make('firstPriceList.sourceLanguage.name')->limit(50)->toggleable()->searchable(true, null, true),
                Tables\Columns\TextColumn::make('firstPriceList.targetLanguage.name')->limit(50)->toggleable()->searchable(true, null, true),
                Tables\Columns\TextColumn::make('translatorType.name')->limit(50)->sortable()->toggleable()->searchable(true, null, true),
                Tables\Columns\TextColumn::make('country.name')->limit(50)->toggleable(),
            ])
            ->defaultSort('id', 'desc')
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
            TranslatorResource\RelationManagers\TranslatorPriceListsRelationManager::class,
            TranslatorResource\RelationManagers\TasksRelationManager::class,
            TranslatorResource\RelationManagers\PhonesRelationManager::class,
            TranslatorResource\RelationManagers\EmailsRelationManager::class,
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
//            'find' => \App\Filament\Components\FindTranslators::route('/find'),
        ];
    }

    //    protected static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }
}
