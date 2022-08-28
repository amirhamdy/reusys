<?php

namespace Database\Seeders;

use App\Models\Pricebook;
use Illuminate\Database\Seeder;

class PricebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pricebook::factory()
            ->count(5)
            ->create();
    }
}
