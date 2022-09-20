<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Opportunity::factory()
            ->count(5)
            ->create();
    }
}
