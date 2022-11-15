<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class NotPaidTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $navigationLabel = 'Not Paid Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('is_paid', '=', 'Not Paid');
    }

//    protected static function getNavigationBadge(): ?string
//    {
//        return Task::where('is_paid', '=', 'Not Paid')->count();
//    }
}
