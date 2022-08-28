<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'fax' => $this->faker->text(255),
            'website' => $this->faker->text(255),
            'address' => $this->faker->text(255),
            'postal_code' => $this->faker->text(255),
            'city' => $this->faker->city,
            'billing_address' => $this->faker->text(255),
            'customer_status_id' => \App\Models\CustomerStatus::factory(),
            'country_id' => \App\Models\Country::factory(),
            'region_id' => \App\Models\Region::factory(),
            'customer_rating_id' => \App\Models\CustomerRating::factory(),
            'industry_id' => \App\Models\Industry::factory(),
        ];
    }
}
