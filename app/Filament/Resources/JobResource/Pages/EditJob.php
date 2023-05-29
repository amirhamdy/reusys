<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use App\Helpers\CurrencyConverter;
use App\Mail\SendNotificationEmail;
use App\Models\Productline;
use App\Models\Project;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditJob extends EditRecord
{
    protected static string $resource = JobResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $project = Project::find($data['project_id']);

        $data['productline_id'] = $project->productline->name;
        $data['customer_id'] = $project->productline->customer->name;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $cost = $data['cost'];

        // Set the default cost in USD to zero
        $data['cost_usd'] = 0;

        if ($cost > 0) {
            $productline = Productline::find($data['productline_id']);

            if ($productline) {
                $currency = strtoupper($productline->pricebook->currency->name);

                if ($currency !== 'USD') {
                    try {
                        $costInUSD = CurrencyConverter::calculateCostInCurrency($cost, $currency);
                        $data['cost_usd'] = $costInUSD;
                    } catch (\Exception $e) {
                        // Handle currency conversion error if needed
                    }
                } else {
                    $data['cost_usd'] = $cost;
                }
            }
        }

        return $data;
    }

    function afterSave()
    {
        Mail::send(new SendNotificationEmail($this->record, 'updated', 'job'));
    }
}
