<?php

namespace Database\Seeders;

use App\Models\Portal;
use Illuminate\Database\Seeder;

class PortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Portal::factory()
            ->count(5)
            ->create();
    }
}
