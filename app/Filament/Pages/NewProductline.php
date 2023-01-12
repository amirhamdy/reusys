<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ProductlineResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;

class NewProductline extends CreateRecord
{
    protected static string $resource = ProductlineResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-plus';

    protected static ?string $navigationGroup = 'Product Lines';

    protected static ?string $navigationLabel = 'New Product Line';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('customer_status_id', '=', 2);
    }
}
