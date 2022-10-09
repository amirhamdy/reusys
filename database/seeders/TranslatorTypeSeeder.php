<?php

namespace Database\Seeders;

use App\Models\TranslatorType;
use Illuminate\Database\Seeder;

class TranslatorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TranslatorType::factory()
            ->count(5)
            ->create();
    }
}
