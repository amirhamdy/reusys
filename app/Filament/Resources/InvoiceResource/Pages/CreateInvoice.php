<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\InvoiceResource;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function afterFill(): void
    {
        $this->data['invoiceJobs'][0]['customer_id'] = request()->query('customer_id');
        $this->data['invoiceJobs'][0]['project_id'] = request()->query('project_id');
    }
}
