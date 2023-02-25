<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use App\Mail\SendNotificationEmail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateJob extends CreateRecord
{
    protected static string $resource = JobResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['cost_usd'] = $data['cost'] * 20;
        return $data;
    }

    function afterCreate($record)
    {
        Mail::send(new SendNotificationEmail($record, 'created', 'job'));
    }
}
