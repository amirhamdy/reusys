<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TranslatorResource;

class CreateTranslator extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = TranslatorResource::class;

    protected static ?string $title = 'Resource';

    protected static ?string $navigationLabel = 'Resources';

    protected static ?string $slug = 'resources';

    protected function getSteps(): array
    {
        return [
            TranslatorResource::getFirstStep(),
            TranslatorResource::getSecondStep(),
            TranslatorResource::getThirdStep(),
        ];
    }
}
