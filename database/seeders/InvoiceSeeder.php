<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->delete();

        $data = array();
        $path = public_path('../database/dump/invoice.csv');
        $invoices = readCSVFile($path);

        // ID,created_date,invoice_date,bank_ID,creator_ID,invoice_status,invoice_cost,invoice_cost_usd,invoice_note,paid_date
        foreach ($invoices as $invoice) {
            if (is_array($invoice)) {
                $keys = array('id', 'created_at', 'date', 'bank_id', 'creator_ID', 'invoice_status', 'invoice_cost', 'invoice_cost_usd', 'notes', 'paid_date');

                $values = array_values($invoice);
                $j = array_combine($keys, $values);
                $j['updated_at'] = $j['created_at'];
                $j['paid'] = $j['invoice_status'] == 'Paid';
                $j['paid_date'] = $j['paid'] ? $j['paid_date'] ?: $j['date'] : null;
                $j['number'] = 'REU6656-' . date('Ymd', strtotime($j['date'])) . '-' . $j['id'];

                unset($j['creator_ID']);
                unset($j['invoice_status']);
                unset($j['invoice_cost']);
                unset($j['invoice_cost_usd']);

                $data[] = $j;
            }
        }

        foreach (array_chunk($data, 1000) as $t) {
            DB::table('invoices')->insert($t);
        }
    }
}
