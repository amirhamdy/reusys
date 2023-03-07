<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class InProgressTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-information-circle';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $navigationLabel = 'In Progress Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('status', '=', 'In Progress');
    }

    protected static function getNavigationBadge(): ?string
    {
        return Task::where('status', '=', 'In Progress')->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Task::where('status', '=', 'In Progress')->count() > 0 ? 'warning' : 'primary';
    }
}
