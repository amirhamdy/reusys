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
            'degree' => $this->faker->text(255),
            'gender' => \Arr::random(['male', 'female', 'other']),
            'date_of_birth' => $this->faker->date,
            'nationality' => $this->faker->text(255),
            'experience' => $this->faker->text(255),
            'id_number' => $this->faker->text(255),
            'vat_number' => $this->faker->text(255),
            'id_other' => $this->faker->text(255),
            'timezone' => $this->faker->text(255),
            'website' => $this->faker->text(255),
            'skype' => $this->faker->text(255),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->text(255),
            'payment_after' => $this->faker->text(255),
            'nda' => $this->faker->boolean,
            'cv' => $this->faker->boolean,
            'native_language' => $this->faker->text(255),
            'second_language' => $this->faker->text(255),
            'translator_type_id' => \App\Models\TranslatorType::factory(),
            'currency_id' => \App\Models\Currency::factory(),
            'country_id' => \App\Models\Country::factory(),
        ];
    }
}
