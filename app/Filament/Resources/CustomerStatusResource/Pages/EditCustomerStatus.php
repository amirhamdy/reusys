<?php

namespace App\Filament\Resources\CustomerStatusResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerStatusResource;

class EditCustomerStatus extends EditRecord
{
    protected static string $resource = CustomerStatusResource::class;
}
