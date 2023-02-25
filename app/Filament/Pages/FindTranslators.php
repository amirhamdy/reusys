<?php

namespace App\Filament\Pages;

use App\Filament\Components\DescriptionList;
use App\Filament\Resources\TranslatorResource;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Translator;
use Closure;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Pages\Contracts\HasFormActions;
use Filament\Resources\Pages\Concerns\UsesResourceForm;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FindTranslators extends ListRecords
{
    use UsesResourceForm;

    protected static bool $shouldRegisterNavigation = false;

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
            Select::make('resource_id')
                ->label('Resource')
                ->options(Translator::query()->pluck('name', 'id')->lazy())
                ->required(),
//            Select::make('source_language')
//                ->label('Source Language')
//                ->options(Job::query()->pluck('source_language', 'source_language')->lazy())
//                ->required(),
//            Select::make('target_language')
//                ->label('Target Language')
//                ->options(Job::query()->pluck('target_language', 'target_language')->lazy())
//                ->required(),
        ];
    }

    public int $resource_id = 0;

    public function submit() {}

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('id', '=', $this->resource_id);
    }
}
