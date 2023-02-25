<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Mail\SendNotificationEmail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProjectResource;
use Illuminate\Support\Facades\Mail;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    function afterCreate()
    {
        Mail::send(new SendNotificationEmail($this->record, 'created', 'project'));
    }
}
