<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use App\Filament\Resources\TranslatorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTranslator extends ViewRecord
{
    protected static string $resource = TranslatorResource::class;

    protected static ?string $title = 'Resource';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';
}
