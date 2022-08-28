<?php

namespace Database\Factories;

use App\Models\Pricelist;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricelistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pricelist::class;

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
            'subject_matter_id' => \App\Models\SubjectMatter::factory(),
            'job_type_id' => \App\Models\JobType::factory(),
            'job_unit_id' => \App\Models\JobUnit::factory(),
            'pricebook_id' => \App\Models\Pricebook::factory(),
            'source_language_id' => \App\Models\Language::factory(),
            'target_language_id' => \App\Models\Language::factory(),
        ];
    }
}
