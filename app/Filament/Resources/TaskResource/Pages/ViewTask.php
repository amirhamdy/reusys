<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Resources\Pages\ViewRecord;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

//    protected function mutateFormDataBeforeFill(array $data): array
//    {
//        $job = Job::find($data['job_id']);
//
//        $data['project_id'] = $job->project->name;
//        $data['productline_id'] = $job->project->productline->name;
//        $data['customer_id'] = $job->project->productline->customer->name;
//
//        return $data;
//    }
}
