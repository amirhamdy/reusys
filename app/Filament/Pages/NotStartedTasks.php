<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class NotStartedTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-stop';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $navigationLabel = 'Not Started Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('status', '=', 'Not Started');
    }

    protected static function getNavigationBadge(): ?string
    {
        return Task::where('status', '=', 'Not Started')->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Task::where('status', '=', 'Not Started')->count() > 0 ? 'danger' : 'primary';
    }
}
