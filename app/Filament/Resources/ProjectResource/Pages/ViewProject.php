<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Customer;
use App\Models\Productline;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $productline = Productline::find($data['productline_id']);

        $data['productline_id'] = $productline->name;
        $data['customer_id'] = $productline->customer->name;

        return $data;
    }
}
