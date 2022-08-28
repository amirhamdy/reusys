<?php

namespace App\Filament\Resources\CustomerRatingResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomerRatingResource;

class ListCustomerRatings extends ListRecords
{
    protected static string $resource = CustomerRatingResource::class;
}
