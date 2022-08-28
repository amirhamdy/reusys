<?php

namespace App\Filament\Resources\CountryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CountryResource;

class ListCountries extends ListRecords
{
    protected static string $resource = CountryResource::class;
}
