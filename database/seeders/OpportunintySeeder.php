<?php

namespace Database\Seeders;

use App\Models\Opportuninty;
use Illuminate\Database\Seeder;

class OpportunintySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Opportuninty::factory()
            ->count(5)
            ->create();
    }
}
