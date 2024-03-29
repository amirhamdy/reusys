<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CustomerRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerRating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
