<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TranslatorResource;

class EditTranslator extends EditRecord
{
    protected static string $resource = TranslatorResource::class;

    protected static ?string $title = 'Resource';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';
}
