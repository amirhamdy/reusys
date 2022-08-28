<?php

namespace Database\Seeders;

use App\Models\TaskUnit;
use Illuminate\Database\Seeder;

class TaskUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskUnit::factory()
            ->count(5)
            ->create();
    }
}
