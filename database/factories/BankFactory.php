<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'label' => $this->faker->name,
            'account_number' => $this->faker->text(255),
            'account_name' => $this->faker->name,
            'routing_number' => $this->faker->text(255),
            'country_id' => \App\Models\Country::factory(),
        ];
    }
}
