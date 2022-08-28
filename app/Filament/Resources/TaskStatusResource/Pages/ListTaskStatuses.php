<?php

namespace App\Filament\Resources\TaskStatusResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TaskStatusResource;

class ListTaskStatuses extends ListRecords
{
    protected static string $resource = TaskStatusResource::class;
}
