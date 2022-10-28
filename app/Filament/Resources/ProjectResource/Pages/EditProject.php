<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Models\Customer;
use App\Models\Productline;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ProjectResource;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $productline = Productline::find($data['productline_id']);

        $data['productline_id'] = $productline->name;
        $data['customer_id'] = Customer::find($productline['customer_id'])->name;

        return $data;
    }
}
