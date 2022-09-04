<?php

namespace Database\Factories;

use App\Models\Portal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Portal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'url' => $this->faker->url,
            'username' => $this->faker->text(255),
            'password' => $this->faker->password,
        ];
    }
}
