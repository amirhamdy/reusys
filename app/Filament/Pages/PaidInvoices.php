<?php

namespace App\Filament\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class PaidInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-cash';

    protected static ?string $navigationGroup = 'Invoices';

    protected static ?string $navigationLabel = 'Paid Invoices';

    protected static ?string $recordTitleAttribute = 'number';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('paid', '=', true);
    }

    protected static function getNavigationBadge(): ?string
    {
        return Invoice::where('paid', '=', true)->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Invoice::where('paid', '=', true)->count() > 0 ? 'success' : 'danger';
    }
}
