<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Saved successfully!')
            ->body('The task has been created successfully.')
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();
    }
}
