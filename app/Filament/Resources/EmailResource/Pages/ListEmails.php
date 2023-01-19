<?php

namespace App\Filament\Resources\EmailResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\EmailResource;
use App\Filament\Traits\HasDescendingOrder;

class ListEmails extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = EmailResource::class;
}
