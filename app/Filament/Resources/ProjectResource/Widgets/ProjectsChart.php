<?php

namespace App\Filament\Resources\ProjectResource\Widgets;

use App\Models\Project;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectsChart extends LineChartWidget
{
    protected static ?int $sort = 1;

    public ?string $filter = 'today';

    protected static ?string $heading = 'Chart';

    protected function getHeading(): string
    {
        return 'Projects per month';
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $data = Trend::model(Project::class)
            ->between(
                start: now()->startOfDecade(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
//            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}