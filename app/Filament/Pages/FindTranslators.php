<?php

namespace App\Filament\Pages;

use App\Filament\Components\DescriptionList;
use App\Filament\Resources\TranslatorResource;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Language;
use App\Models\Translator;
use App\Models\TranslatorType;
use Closure;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Pages\Contracts\HasFormActions;
use Filament\Resources\Pages\Concerns\UsesResourceForm;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FindTranslators extends ListRecords
{
    use UsesResourceForm;

//    protected static bool $shouldRegisterNavigation = false;

    protected static string $resource = TranslatorResource::class;
    protected static ?string $slug = 'resources/find';

    protected static string $view = 'filament.resources.translator-resource.pages.find-translators';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-s-search';

    protected static ?string $navigationGroup = 'Resources';

    protected static ?string $navigationLabel = 'Find Resources';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $breadcrumb = 'Find Resources';

    protected static ?string $title = 'Find Resources';

    protected static ?string $description = 'Find Resources';

    protected static ?string $icon = 'heroicon-s-search';

    //    protected function getActions(): array
//    {
//        return [
//            Action::make('updateAuthor')
//                ->action(function (array $data): void {
//                    $this->record->author()->associate($data['resource_id']);
//                    $this->record->save();
//                })
//                ->form([
//                ])
//        ];
//    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()->schema([
                Grid::make()->schema([
                    Select::make('resource_id')
                        ->label('Resource Name')
                        ->options(Translator::all()->pluck('name', 'id')->lazy())
                        ->preload()
                        ->searchable(),
                    Select::make('translator_type_id')
                        ->label('Translator Type')
                        ->options(TranslatorType::all()->pluck('name', 'id')->lazy())
                        ->preload()
                        ->searchable(),
                    Select::make('source_language')
                        ->label('Source Language')
                        ->options(Language::all()->pluck('name', 'id')->lazy())
                        ->preload()
                        ->searchable(),
                    Select::make('target_language')
                        ->label('Target Language')
                        ->options(Language::all()->pluck('name', 'id')->lazy())
                        ->preload()
                        ->searchable(),
                    TextInput::make('email')
                        ->label('Email')
                        ->hint('You can search by partial email address.')->hintColor('danger')
                        ->placeholder('Email'),
                ]),
            ])
        ];
    }

    public $resource_id = null;
    public $source_language = null;
    public $target_language = null;
    public $translator_type_id = null;
    public $email = null;

    public function submit()
    {
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if (!$this->resource_id && !$this->source_language && !$this->target_language && !$this->translator_type_id && !$this->email) {
            return $query->where('id', 0);
        }

        if ($this->resource_id) {
            $query->where('id', $this->resource_id);
        }
        if ($this->source_language) {
            $query->whereHas('translatorPriceLists', function ($query) {
                $query->where('source_language_id', $this->source_language);
            });
        }
        if ($this->target_language) {
            $query->whereHas('translatorPriceLists', function ($query) {
                $query->where('target_language_id', $this->target_language);
            });
        }
        if ($this->translator_type_id) {
            $query->where('translator_type_id', $this->translator_type_id);
        }
        if ($this->email) {
            $query->whereHas('emails', function ($query) {
                $query->where('address', 'like', '%' . $this->email . '%');
            });

            $query->orWhereHas('contacts', function ($query) {
                $query->where('email', 'like', '%' . $this->email . '%');
            });
        }

        return $query;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Name')->limit(50),
            TextColumn::make('emails.address')->label('Email')->limit(50),
            TextColumn::make('contacts.email')->label('Contact Email')->limit(50),
            TextColumn::make('translatorType.name')->label('Translator Type'),
            TextColumn::make('firstPriceList.sourceLanguage.name')->label('First Source Language')->limit(50),
            TextColumn::make('firstPriceList.targetLanguage.name')->label('First Target Language')->limit(50),
        ];
    }

    protected function getTableFilters(): array
    {
        return [];
    }

    protected function getTableActions(): array
    {
        return [];
    }

    protected function getTableBulkActions(): array
    {
        return [];
    }
}
