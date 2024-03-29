<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'start_date' => $this->faker->date,
            'delivery_date' => $this->faker->date,
            'status' => 'Not Started',
            'amount' => $this->faker->randomNumber(0),
            'is_paid' => 'Not Paid',
            'cost' => $this->faker->randomNumber(2),
            'payment_date' => $this->faker->date,
            'notes' => $this->faker->text,
            'job_id' => \App\Models\Job::factory(),
            'task_type_id' => \App\Models\TaskType::factory(),
            'task_unit_id' => \App\Models\TaskUnit::factory(),
            'subject_matter_id' => \App\Models\SubjectMatter::factory(),
            'translator_id' => \App\Models\Translator::factory(),
        ];
    }
}
