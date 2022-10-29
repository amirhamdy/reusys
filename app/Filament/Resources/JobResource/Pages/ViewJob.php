<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use App\Models\Project;
use Filament\Resources\Pages\ViewRecord;

class ViewJob extends ViewRecord
{
    protected static string $resource = JobResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $project = Project::find($data['project_id']);

        $data['project_id'] = $project->name;
        $data['productline_id'] = $project->productline->name;
        $data['customer_id'] = $project->productline->customer->name;

        return $data;
    }
}
