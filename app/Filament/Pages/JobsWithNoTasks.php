<?php

namespace App\Filament\Pages;

use App\Filament\Resources\JobResource;
use App\Models\Job;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class JobsWithNoTasks extends ListRecords
{
    protected static string $resource = JobResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    protected static ?string $navigationGroup = 'Jobs';

    protected static ?string $navigationLabel = 'Jobs with no tasks';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->whereDoesntHave('tasks', function ($query) {});
    }

    protected static function getNavigationBadge(): ?string
    {
        return Job::whereDoesntHave('tasks', function ($query) {})->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Job::whereDoesntHave('tasks', function ($query) {})->count() > 0 ? 'warning' : 'primary';
    }
}
