<?php

namespace App\Filament\Resources\JobResource\Widgets;

use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class JobStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Jobs', Job::count()),
            Card::make('Job Costs', Job::sum('cost')),
            Card::make('Average price', number_format(Job::avg('cost'), 2)),
        ];
    }
}
