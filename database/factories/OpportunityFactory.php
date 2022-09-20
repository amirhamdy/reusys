<?php

namespace Database\Factories;

use App\Models\Opportunity;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Opportunity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'date' => $this->faker->date,
            'description' => $this->faker->sentence(15),
            'amount' => $this->faker->randomNumber(0),
            'price' => $this->faker->randomNumber(0),
            'probability_to_win' => $this->faker->text(255),
            'status' => $this->faker->word,
            'productline_id' => \App\Models\Productline::factory(),
            'source_language_id' => \App\Models\Language::factory(),
            'target_language_id' => \App\Models\Language::factory(),
            'opportunity_type_id' => \App\Models\OpportunityType::factory(),
            'opportunity_unit_id' => \App\Models\OpportunityUnit::factory(),
        ];
    }
}
