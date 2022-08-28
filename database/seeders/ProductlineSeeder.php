<?php

namespace Database\Seeders;

use App\Models\Productline;
use Illuminate\Database\Seeder;

class ProductlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productline::factory()
            ->count(5)
            ->create();
    }
}
