<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();

        $data = array();
        $path = public_path('../database/dump/tasks.csv');
        $tasks = readCSVFile($path);

        foreach ($tasks as $task) {
            if (is_array($task)) {
                $keys = array("task_ID", "task_name", "task_startdate", "task_enddate", "task_amount", "task_paid", "task_note", "job_ID", "task_type_ID", "unit_ID", "task_subject_matter_ID", "task_status", "resource_ID", "created_date", "task_cost", "creator_ID", "task_payment_date");

                $values = array_values($task);
                $t = array_combine($keys, $values);

                $input = array(
                    'id' => $t['task_ID'],
                    'name' => $t['task_name'],
                    'start_date' => $t['task_startdate'],
                    'delivery_date' => $t['task_enddate'],
                    'amount' => $t['task_amount'],
                    'is_paid' => $t['task_paid'],
                    'notes' => $t['task_note'],
                    'job_id' => $t['job_ID'],
                    'task_type_id' => $t['task_type_ID'],
                    'task_unit_id' => $t['unit_ID'],
                    'subject_matter_id' => $t['task_subject_matter_ID'] == NULL ? 700 : $t['task_subject_matter_ID'],
                    'task_status_id' => $t['task_status'],
                    'translator_id' => $t['resource_ID'],
                    'created_at' => $t['created_date'],
                    'updated_at' => $t['created_date'],
                );

                DB::table('tasks')->insert($t);

                $data[] = $input;
            }
        }

//        DB::table('tasks')->insert($data);
    }
}
