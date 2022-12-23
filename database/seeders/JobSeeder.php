<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->delete();

        $data = array();
        $path = public_path('../database/dump/jobs.csv');
        $jobs = readCSVFile($path);

        // 3000019,"Full Translation ",19874,"",3676.69,2000032,126,84,4,339,"2016-11-30 07:59:57"
        foreach ($jobs as $job) {
            if (is_array($job)) {
                $keys = array('id', 'name', 'amount', 'is_minimum_charge_used', 'cost', 'project_id', 'source_language_id', 'target_language_id', 'job_type_id', 'job_unit_id', 'created_at');

                $values = array_values($job);
                $j = array_combine($keys, $values);
                $j['is_minimum_charge_used'] = (int)($j['is_minimum_charge_used']);
                $j['name'] = trim($j['name']);
                $j['updated_at'] = $j['created_at'];
                $j['is_free_job'] = $j['cost'] == 0;
                $j['cost_usd'] = $j['cost'] * 20;

                $data[] = $j;
            }
        }

        foreach (array_chunk($data, 2000) as $t) {
            DB::table('jobs')->insert($t);
        }
    }
}
