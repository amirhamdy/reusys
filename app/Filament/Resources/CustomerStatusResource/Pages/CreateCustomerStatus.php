<?php

namespace App\Filament\Resources\CustomerStatusResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CustomerStatusResource;

class CreateCustomerStatus extends CreateRecord
{
    protected static string $resource = CustomerStatusResource::class;
}
