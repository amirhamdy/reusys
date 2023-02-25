<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Mail\SendNotificationEmail;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;
use Illuminate\Support\Facades\Mail;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function afterSave(): void
    {
        Mail::send(new SendNotificationEmail($this->record, 'updated', 'customer'));
    }
}
