<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use App\Mail\SendNotificationEmail;
use App\Models\Project;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditJob extends EditRecord
{
    protected static string $resource = JobResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $project = Project::find($data['project_id']);

        $data['productline_id'] = $project->productline->name;
        $data['customer_id'] = $project->productline->customer->name;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['cost_usd'] = $data['cost'] * 20;
        return $data;
    }

    function afterSave()
    {
        Mail::send(new SendNotificationEmail($this->record, 'updated', 'job'));
    }
}
