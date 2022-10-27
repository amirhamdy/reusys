<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TranslatorResource;

class CreateTranslator extends CreateRecord
{
    protected static string $resource = TranslatorResource::class;

    protected static ?string $title = 'Resource';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';
}
