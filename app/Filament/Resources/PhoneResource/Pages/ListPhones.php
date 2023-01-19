<?php

namespace App\Filament\Resources\PhoneResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PhoneResource;
use App\Filament\Traits\HasDescendingOrder;

class ListPhones extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = PhoneResource::class;
}
