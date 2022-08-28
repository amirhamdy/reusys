<?php

namespace App\Filament\Resources\JobTypeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\JobTypeResource;

class ListJobTypes extends ListRecords
{
    protected static string $resource = JobTypeResource::class;
}
