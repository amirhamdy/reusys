<?php

namespace App\Filament\Resources\CustomerStatusResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomerStatusResource;

class ListCustomerStatuses extends ListRecords
{
    protected static string $resource = CustomerStatusResource::class;
}
