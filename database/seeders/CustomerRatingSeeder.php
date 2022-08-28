<?php

namespace Database\Seeders;

use App\Models\CustomerRating;
use Illuminate\Database\Seeder;

class CustomerRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerRating::factory()
            ->count(5)
            ->create();
    }
}
