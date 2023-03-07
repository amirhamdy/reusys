<?php

namespace App\Filament\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Carbon\Carbon;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class OverdueInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-view-list';

    protected static ?string $navigationGroup = 'Invoices';

    protected static ?string $navigationLabel = 'Overdue Invoices';

    protected static ?string $recordTitleAttribute = 'number';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('paid', '=', false)->where('date', '<', Carbon::now()->subDays(45));
    }

    protected static function getNavigationBadge(): ?string
    {
        return Invoice::where('paid', '=', false)->where('date', '<', Carbon::now()->subDays(45))->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Invoice::where('paid', '=', false)->where('date', '<', Carbon::now()->subDays(45))->count() > 0 ? 'danger' : 'primary';
    }
}
