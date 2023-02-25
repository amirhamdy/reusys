<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class LeadCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationLabel = 'Leads Customers';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('customer_status_id', '=', 1);
    }

    protected static function getNavigationBadge(): ?string
    {
        return Customer::where('customer_status_id', '=', 1)->count();
    }
}
