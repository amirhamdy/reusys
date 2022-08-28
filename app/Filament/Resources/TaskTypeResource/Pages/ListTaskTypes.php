<?php

namespace App\Filament\Resources\TaskTypeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TaskTypeResource;

class ListTaskTypes extends ListRecords
{
    protected static string $resource = TaskTypeResource::class;
}
