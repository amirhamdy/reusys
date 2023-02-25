<?php

namespace App\Filament\Resources\ProductlineResource\Pages;

use App\Mail\SendNotificationEmail;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ProductlineResource;
use Illuminate\Support\Facades\Mail;

class EditProductline extends EditRecord
{
    protected static string $resource = ProductlineResource::class;

    protected function afterSave(): void
    {
        Mail::send(new SendNotificationEmail($this->record, 'updated', 'productline'));
    }
}
