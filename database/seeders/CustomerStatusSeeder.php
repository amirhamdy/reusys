<?php

namespace Database\Seeders;

use App\Models\CustomerStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_statuses')->delete();

        DB::table('customer_statuses')->insert([
            ['name' => 'Lead', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Prospect', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['name' => 'Customer', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
