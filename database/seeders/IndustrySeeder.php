<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industries')->delete();

        DB::table('industries')->insert([
            ['id' => 1000, 'name' => 'Agriculture &amp; Environment', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1001, 'name' => 'Arts &amp; Entertainment', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1002, 'name' => 'Automotive &amp; transport', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1003, 'name' => 'Consumer Goods &amp; Electronics', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1004, 'name' => 'Education &amp; Training', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1005, 'name' => 'Energy &amp; Raw Material', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1006, 'name' => 'Finance', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1007, 'name' => 'Government &amp; Organization', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1008, 'name' => 'Individual', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1009, 'name' => 'Industrial &amp; Manufacturing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1010, 'name' => 'Legal &amp; Corporate', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1011, 'name' => 'Media &amp; Publishing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1012, 'name' => 'Medical &amp; Healthcare', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1013, 'name' => 'Other', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1014, 'name' => 'Professional Services', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1015, 'name' => 'Technology &amp; Telecom', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1016, 'name' => 'Trade &amp; Retail', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1017, 'name' => 'Translation &amp; Interpreting', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1018, 'name' => 'Unknown', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1019, 'name' => 'Advertising &amp; Marketing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1020, 'name' => 'Software', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1021, 'name' => 'Advertising & amp; Marketing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1022, 'name' => 'Automotive', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
