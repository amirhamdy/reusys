<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TranslatorPriceList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslatorPriceListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TranslatorPriceList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit_price' => $this->faker->randomNumber(0),
            'minimum_charge' => $this->faker->randomNumber(0),
            'task_type_id' => \App\Models\TaskType::factory(),
            'target_language_id' => \App\Models\Language::factory(),
            'source_language_id' => \App\Models\Language::factory(),
            'subject_matter_id' => \App\Models\SubjectMatter::factory(),
            'currency_id' => \App\Models\Currency::factory(),
            'task_unit_id' => \App\Models\TaskUnit::factory(),
            'translator_id' => \App\Models\Translator::factory(),
        ];
    }
}
