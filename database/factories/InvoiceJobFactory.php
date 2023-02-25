<?php

namespace Database\Factories;

use App\Models\InvoiceJob;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceJobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceJob::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomNumber(0),
            'cost' => $this->faker->randomNumber(0),
            'cost_usd' => $this->faker->randomNumber(0),
            'invoice_id' => \App\Models\Invoice::factory(),
            'job_id' => \App\Models\Job::factory(),
        ];
    }
}
