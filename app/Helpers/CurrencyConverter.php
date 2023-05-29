<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    public static function calculateCostInCurrency(float $cost, string $fromCurrency, string $toCurrency = 'USD'): float
    {
        $cacheKey = "conversion_rate_{$fromCurrency}_to_{$toCurrency}";

        // Check if the conversion rate is already cached
        if (Cache::has($cacheKey)) {
            $conversionRate = Cache::get($cacheKey);
        } else {
            try {
                // Fetch the conversion rates from the API call
                $apiKey = '292cb407e7204236bab0ed79';
                $response = Http::get('https://v6.exchangerate-api.com/v6/' . $apiKey . '/latest/' . $fromCurrency);

                /*
                          array:9 [▼ // app/Filament/Resources/JobResource/Pages/CreateJob.php:32
                          "result" => "success"
                          "documentation" => "https://www.exchangerate-api.com/docs"
                          "terms_of_use" => "https://www.exchangerate-api.com/terms"
                          "time_last_update_unix" => 1685318402
                          "time_last_update_utc" => "Mon, 29 May 2023 00:00:02 +0000"
                          "time_next_update_unix" => 1685404802
                          "time_next_update_utc" => "Tue, 30 May 2023 00:00:02 +0000"
                          "base_code" => "EGP"
                          "conversion_rates" => array:162 [▶]
                        ]
                */
                if ($response->successful()) {
                    $conversionRates = $response->json()['conversion_rates'];

                    $conversionRate = $conversionRates[$toCurrency];

                    // Cache the conversion rate for future use
                    Cache::put($cacheKey, $conversionRate, 60 * 24); // Cache for 24 hours (adjust the expiration time as needed)
                }
            } catch (\Exception $e) {
                // Do nothing
            }
        }

        // If the conversion rate is available, calculate the converted cost
        if (isset($conversionRate)) {
            $convertedCost = $cost / $conversionRate;

            // Format the converted cost to three decimal places
            $formattedCost = round($convertedCost, 3);

            // Handle cases where the formatted cost may be zero or very small due to rounding
            if ($formattedCost < 0.001 && $formattedCost > 0) {
                // Set a minimum value for the formatted cost
                $formattedCost = 0.001;
            }

            return $formattedCost;
        }

        // Fetch the conversion rates from the conversionRates.php file
        $conversionRates = config('conversionRates');

        // Check if the conversion rates for the given currencies exist
        if (isset($conversionRates[$fromCurrency]) && isset($conversionRates[$fromCurrency][$toCurrency])) {
            $conversionRate = $conversionRates[$fromCurrency][$toCurrency];
            return round($cost / $conversionRate, 3);
        }

        // Return the original cost if no conversion rate is available
        return $cost;
    }
}
