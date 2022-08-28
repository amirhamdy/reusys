<?php

namespace Database\Seeders;

use App\Models\Translator;
use Illuminate\Database\Seeder;

class TranslatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Translator::factory()
            ->count(5)
            ->create();
    }
}
