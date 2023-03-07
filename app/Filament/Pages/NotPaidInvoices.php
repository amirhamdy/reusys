<?php

namespace App\Filament\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class NotPaidInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-cash';

    protected static ?string $navigationGroup = 'Invoices';

    protected static ?string $navigationLabel = 'Not Paid Invoices';

    protected static ?string $recordTitleAttribute = 'number';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('paid', '=', false);
    }

    protected static function getNavigationBadge(): ?string
    {
        return Invoice::where('paid', '=', false)->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Invoice::where('paid', '=', false)->count() > 0 ? 'danger' : 'primary';
    }
}
