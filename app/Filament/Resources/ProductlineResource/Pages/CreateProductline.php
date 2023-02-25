<?php

namespace App\Filament\Resources\ProductlineResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductlineResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNotificationEmail;

class CreateProductline extends CreateRecord
{
    protected static string $resource = ProductlineResource::class;

    protected function afterCreate(): void
    {
        Mail::send(new SendNotificationEmail($this->record, 'created', 'productline'));
    }
}
