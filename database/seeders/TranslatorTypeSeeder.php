<?php

namespace Database\Seeders;

use App\Models\TranslatorType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslatorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translator_types')->delete();

        DB::table('translator_types')->insert([
            ['id' => 1, 'name' => 'Vendor', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 2, 'name' => 'Agency', 'created_at' => ' 2016-12-03 00:50:23', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
