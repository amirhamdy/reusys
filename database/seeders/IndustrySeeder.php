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
            ['name' => 'Agriculture &amp; Environment', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Arts &amp; Entertainment', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Automotive &amp; transport', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Consumer Goods &amp; Electronics', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Education &amp; Training', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Energy &amp; Raw Material', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Finance', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Government &amp; Organization', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Individual', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Industrial &amp; Manufacturing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Legal &amp; Corporate', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Media &amp; Publishing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Medical &amp; Healthcare', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Other', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Professional Services', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Technology &amp; Telecom', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Trade &amp; Retail', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Translation &amp; Interpreting', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Unknown', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Advertising &amp; Marketing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Software', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Advertising & amp; Marketing', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Automotive', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
