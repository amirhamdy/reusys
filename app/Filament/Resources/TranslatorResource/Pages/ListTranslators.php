<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TranslatorResource;

class ListTranslators extends ListRecords
{
    protected static string $resource = TranslatorResource::class;

    protected static ?string $title = 'Resources';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';
}
