<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'amount' => $this->faker->randomNumber(0),
            'is_free_job' => $this->faker->boolean,
            'is_minimum_charge_used' => $this->faker->boolean,
            'source_language_id' => \App\Models\Language::factory(),
            'target_language_id' => \App\Models\Language::factory(),
            'job_type_id' => \App\Models\JobType::factory(),
            'job_unit_id' => \App\Models\JobUnit::factory(),
            'project_id' => \App\Models\Project::factory(),
        ];
    }
}
