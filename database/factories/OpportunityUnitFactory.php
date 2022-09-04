<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\OpportunityUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpportunityUnit::class;

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
