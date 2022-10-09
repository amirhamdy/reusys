<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TranslatorPriceList;

class TranslatorPriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TranslatorPriceList::factory()
            ->count(5)
            ->create();
    }
}
