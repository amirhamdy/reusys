<?php

namespace App\Filament\Resources\CurrencyResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CurrencyResource;

class ListCurrencies extends ListRecords
{
    protected static string $resource = CurrencyResource::class;
}
