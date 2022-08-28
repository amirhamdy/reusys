<?php

namespace Database\Factories;

use App\Models\Translator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Translator::class;

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
