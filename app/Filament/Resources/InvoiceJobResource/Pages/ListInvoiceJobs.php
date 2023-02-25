<?php

namespace App\Filament\Resources\InvoiceJobResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\InvoiceJobResource;

class ListInvoiceJobs extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = InvoiceJobResource::class;
}
