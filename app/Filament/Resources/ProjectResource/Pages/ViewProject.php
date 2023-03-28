<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\EditAction;
use App\Models\Productline;
use App\Models\Project;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
//            Action::make('createInvoice')
//                ->color('success')
//                ->url(fn() => url('dashboard/invoices/create?customer_id=' . $this->record->productline->customer->id . '&project_id=' . $this->record->id)),
        ];
    }

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
            if (count($tasks->toArray()))
                $tasks_cost += array_sum(array_column($tasks->toArray(), 'cost_usd'));
        }

        $data['profit'] = number_format((float)($jobs_cost - $tasks_cost), 2, '.', '');
        return $data;
    }
}
