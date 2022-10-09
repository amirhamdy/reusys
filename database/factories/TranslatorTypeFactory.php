<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TranslatorType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslatorTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TranslatorType::class;

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
