<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ProspectCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationLabel = 'Prospects Customers';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('customer_status_id', '=', 2);
    }

//    protected static function getNavigationBadge(): ?string
//    {
//        return Customer::where('customer_status_id', '=', 2)->count();
//    }
}
