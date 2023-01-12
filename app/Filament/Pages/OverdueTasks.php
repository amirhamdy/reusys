<?php

namespace App\Filament\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class OverdueTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-qrcode';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $navigationLabel = 'Overdue Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('is_paid', '!=', 'Paid')
            ->where('delivery_date', '<=', today());
    }

    protected static function getNavigationBadge(): ?string
    {
        return Task::where('is_paid', '!=', 'Paid')
            ->where('delivery_date', '<=', today())
            ->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}
