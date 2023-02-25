<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Mail\SendNotificationEmail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CustomerResource;
use Illuminate\Support\Facades\Mail;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function afterCreate(): void
    {
        Mail::send(new SendNotificationEmail($this->record, 'created', 'customer'));
    }
}
