<?php

namespace Database\Factories;

use App\Models\Pricebook;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricebookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pricebook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'currency_id' => \App\Models\Currency::factory(),
        ];
    }
}
