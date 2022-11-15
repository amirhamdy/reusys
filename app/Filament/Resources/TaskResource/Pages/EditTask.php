<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
//        $job = Job::find($data['job_id']);
//        $data['project_id'] = $job->project->name;
//        $data['productline_id'] = $job->project->productline->name;
//        $data['customer_id'] = $job->project->productline->customer->name;

        return $data;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Saved successfully!')
            ->body('The task has been updated successfully.')
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();
    }

}
