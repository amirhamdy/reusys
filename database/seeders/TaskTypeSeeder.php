<?php

namespace Database\Seeders;

use App\Models\TaskType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_types')->delete();

        DB::table('task_types')->insert([
            ['id' => 500    , 'name' => '3rd Party Proofreading', 'created_at' => '2016-11-21 14:02:55', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 501    , 'name' => 'Analysis', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 502    , 'name' => 'DTP Analysis', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 503    , 'name' => 'DTP Hour', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 504    , 'name' => 'DTP Page', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 506    , 'name' => 'DTP Sign-Off', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 507    , 'name' => 'DTP Solving', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 508    , 'name' => 'Editing', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 509    , 'name' => 'Engineering', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 510    , 'name' => 'Feedback Implementation', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 511    , 'name' => 'Preparation', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 512    , 'name' => 'Proofreading', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 513    , 'name' => 'QC Hour', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 514    , 'name' => 'QC Page', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 515    , 'name' => 'Sign-Off', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 516    , 'name' => 'Testing', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 517    , 'name' => 'Translation Only', 'created_at' => '2016-11-21 14:05:40', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 518    , 'name' => 'Full Translation', 'created_at' => '2016-12-18 19:35:34', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 519    , 'name' => 'Translation and Editing', 'created_at' => '2016-12-18 19:35:34', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 520    , 'name' => 'Transcription Only', 'created_at' => '2017-09-22 17:40:37', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 521    , 'name' => 'Transcription & Translation', 'created_at' => '2017-09-22 17:40:37', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 522    , 'name' => 'Postediting', 'created_at' => '2018-08-31 13:57:28', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 523    , 'name' => 'Interpreting', 'created_at' => '2019-02-08 15:50:49', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 524    , 'name' => 'Subtitling', 'created_at' => '2019-02-08 16:00:01', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 525    , 'name' => 'Copywriting', 'created_at' => '2019-09-11 14:27:32', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
