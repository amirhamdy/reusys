<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_units')->delete();

        DB::table('job_units')->insert([
            ['id' => 331, 'name' => 'Character', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 332, 'name' => 'File', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 333, 'name' => 'Hour', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 334, 'name' => 'Line', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 335, 'name' => 'Page', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 336, 'name' => 'Screen', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 337, 'name' => 'Term', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 338, 'name' => 'Unit', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 339, 'name' => 'Word', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 340, 'name' => 'Minute', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 341, 'name' => 'Item', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09']
        ]);
    }
}
