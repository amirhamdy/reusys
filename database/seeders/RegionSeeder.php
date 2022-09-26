<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();

        DB::table('regions')->insert([
            ['id' => '1000', 'name' => 'U.S.A', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => '1001', 'name' => 'EUROPE', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => '1002', 'name' => 'ASIA', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => '1003', 'name' => 'MEA', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => '1004', 'name' => 'GULF', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
