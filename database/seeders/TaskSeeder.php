<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                    'is_paid' => $t['task_paid'] == 'waive' ? 'Waived Cost' : $t['task_paid'],
                    'status' => $t['task_status'],
                    'cost' => $t['task_cost'],
                    'cost_usd' => $t['task_cost'] * 20,
                    'payment_date' => $t['task_payment_date'] != 'NULL' ? $t['task_payment_date'] : null,
                    'notes' => $t['task_note'],
                    'job_id' => $t['job_ID'],
                    'task_type_id' => $t['task_type_ID'],
                    'task_unit_id' => $t['unit_ID'],
                    'subject_matter_id' => $t['task_subject_matter_ID'] != 'NULL' ? $t['task_subject_matter_ID'] : 700,
                    'translator_id' => $t['resource_ID'],
                    'created_at' => $t['created_date'],
                    'updated_at' => $t['created_date'],
                    'is_minimum_charge_used' => false,
                    'is_free_task' => $t['task_cost'] == 0,
                );

                $data[] = $input;
            }
        }

        DB::table('tasks')->insert($data);
    }
}
