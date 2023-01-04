<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Customer;
use App\Models\Productline;
use App\Models\Project;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $productline = Productline::find($data['productline_id']);

        $data['productline_id'] = $productline->name;
        $data['customer_id'] = $productline->customer->name;

        $jobs_cost = 0;
        $tasks_cost = 0;

        $project = Project::find($data['id']);
        $jobs = $project->jobs;
        foreach ($jobs as $job) {
            $jobs_cost += $job->cost_usd;
            $tasks = $job->tasks;
            if (count($tasks))
                $tasks_cost += array_sum(array_column($tasks, 'cost_usd'));
        }

        $data['profit'] = number_format((float)($jobs_cost - $tasks_cost), 2, '.', '');
        return $data;
    }
}
