<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpportunityUnit;

class OpportunityUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpportunityUnit::factory()
            ->count(5)
            ->create();
    }
}
