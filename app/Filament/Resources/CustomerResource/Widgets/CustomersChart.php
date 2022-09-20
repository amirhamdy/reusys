<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Customer;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CustomersChart extends LineChartWidget
{
    public ?string $filter = 'today';

    protected static ?string $heading = 'Chart';

    protected function getHeading(): string
    {
        return 'Customers per month';
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $data = Trend::model(Customer::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Customers',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
//            'labels' => $data->map(fn(TrendValue $value) => $value->date),
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
