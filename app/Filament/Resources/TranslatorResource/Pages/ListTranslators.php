<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use App\Filament\Pages\FindTranslators;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TranslatorResource;

class ListTranslators extends ListRecords
{
    protected static string $resource = TranslatorResource::class;

    protected static ?string $title = 'Resources';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('find')
                ->label('Find Translator')
                ->icon('heroicon-o-search')
                ->color('success')
                ->action('findTranslator'),
        ];
    }

    public function findTranslator()
    {
        redirect(url(FindTranslators::getUrl()));
    }

}
