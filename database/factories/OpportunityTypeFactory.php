<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\OpportunityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpportunityType::class;

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
