<?php

namespace Database\Seeders;

use App\Models\InvoiceJob;
use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_jobs')->delete();

        $data = array();
        $path = public_path('../database/dump/invoice_job.csv');
        $invoice_jobs = readCSVFile($path);

        // ID,invoice_ID,job_ID,created_date
        foreach ($invoice_jobs as $invoice_job) {
            if (is_array($invoice_job)) {
                $keys = array('id', 'invoice_id', 'job_id', 'created_at');

                $values = array_values($invoice_job);
                $j = array_combine($keys, $values);
                $j['updated_at'] = $j['created_at'];

                $job = Job::find($j['job_id']);

                $j['amount'] = $job->amount;
                $j['cost'] = $job->cost;
                $j['cost_usd'] = $job->cost_usd;

                $data[] = $j;
            }
        }

        foreach (array_chunk($data, 1000) as $t) {
            DB::table('invoice_jobs')->insert($t);
        }

    }
}
