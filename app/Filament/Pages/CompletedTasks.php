<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class CompletedTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-check-circle';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $navigationLabel = 'Completed Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('status', '=', 'Completed');
    }

    protected static function getNavigationBadge(): ?string
    {
        return Task::where('status', '=', 'Completed')->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Task::where('status', '=', 'Completed')->count() > 0 ? 'success' : 'primary';
    }
}
