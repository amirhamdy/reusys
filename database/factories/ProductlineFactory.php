<?php

namespace Database\Factories;

use App\Models\Productline;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductlineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Productline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'pricebook_id' => \App\Models\Pricebook::factory(),
            'customer_id' => \App\Models\Customer::factory(),
        ];
    }
}
