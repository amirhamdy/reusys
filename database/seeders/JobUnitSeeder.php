<?php

namespace Database\Seeders;

use App\Models\JobUnit;
use Illuminate\Database\Seeder;

class JobUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobUnit::factory()
            ->count(5)
            ->create();
    }
}
