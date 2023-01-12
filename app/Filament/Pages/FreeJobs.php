<?php

namespace App\Filament\Pages;

use App\Filament\Resources\JobResource;
use App\Models\Job;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class FreeJobs extends ListRecords
{
    protected static string $resource = JobResource::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    protected static ?string $navigationGroup = 'Jobs';

    protected static ?string $navigationLabel = 'Free Jobs';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('cost', '=', 0);
    }

//    protected static function getNavigationBadge(): ?string
//    {
//        return Job::where('cost', '=', 0)->count();
//    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return Job::where('cost', '=', 0)->count() > 10 ? 'warning' : 'primary';
    }
}
