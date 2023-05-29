<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use App\Helpers\CurrencyConverter;
use App\Mail\SendNotificationEmail;
use App\Models\Productline;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateJob extends CreateRecord
{
    protected static string $resource = JobResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
                        // do nothing
                    }
                } else {
                    $data['cost_usd'] = $cost;
                }
            } else {
                // do nothing
            }
        }

        return $data;
    }

    public function afterCreate(): void
    {
        Mail::send(new SendNotificationEmail($this->record, 'created', 'job'));
    }
}
