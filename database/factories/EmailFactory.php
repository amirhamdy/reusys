<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address,
            'translator_id' => \App\Models\Translator::factory(),
        ];
    }
}
