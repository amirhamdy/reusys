<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_types')->delete();

        DB::table('job_types')->insert([
            ['id' => 1, 'name' => 'Full DTP	', 'created_at' => ' 2016-10-31 12:15:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 2, 'name' => 'Translation and Editing	', 'created_at' => ' 2016-12-03 00:50:23', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 3, 'name' => 'Engineering	', 'created_at' => ' 2016-10-31 12:16:31', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 4, 'name' => 'Translation, Editing and Proofreading	', 'created_at' => ' 2016-10-31 12:16:31', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 5, 'name' => 'Translation Only	', 'created_at' => ' 2016-10-31 12:16:31', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 6, 'name' => 'Revision Only	', 'created_at' => ' 2016-10-31 12:16:31', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 7, 'name' => 'Proofreading Only	', 'created_at' => ' 2016-11-09 13:02:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 8, 'name' => 'QC Only	', 'created_at' => ' 2016-11-09 13:02:42', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 9, 'name' => 'Transcription	', 'created_at' => ' 2017-09-22 17:31:37', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 10, 'name' => 'Transcription & Translation	', 'created_at' => ' 2017-09-24 14:37:08', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 11, 'name' => 'Postediting	', 'created_at' => ' 2018-08-31 13:54:24', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 12, 'name' => 'Subtitling	', 'created_at' => ' 2019-02-05 21:54:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 13, 'name' => 'Interpreting	', 'created_at' => ' 2019-02-07 10:44:50', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 14, 'name' => 'Copywriting	', 'created_at' => ' 2019-06-12 13:50:45', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 15, 'name' => 'MTPE	', 'created_at' => ' 2021-07-29 14:16:01', 'updated_at' => '2022-09-19 22:47:09'],
        ]);

    }
}
