<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'number' => $this->faker->text(255),
            'paid' => $this->faker->boolean,
            'paid_date' => $this->faker->date,
            'notes' => $this->faker->text,
            'bank_id' => \App\Models\Bank::factory(),
        ];
    }
}
