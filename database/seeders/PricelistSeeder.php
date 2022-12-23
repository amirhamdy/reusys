<?php

namespace Database\Seeders;

use App\Models\Pricelist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pricelists')->delete();

        $data = array();
        $path = public_path('../database/dump/pricelists.csv');
        $pricelists = readCSVFile($path);

        //list_min_charge,created_date,unit_price,unit_ID,job_type_ID,source_language_ID,target_language_ID,price_book_ID,sub_matter_ID
        foreach ($pricelists as $pricelist) {
            if (is_array($pricelist)) {
                $keys = array(
                    'minimum_charge',
                    'created_at',
                    'unit_price',
                    'job_unit_id',
                    'job_type_id',
                    'source_language_id',
                    'target_language_id',
                    'pricebook_id',
                    'subject_matter_id',
                );

                $values = array_values($pricelist);
                $p = array_combine($keys, $values);
                $p['updated_at'] = $p['created_at'];

                if (!$p['subject_matter_id']) {
                    $p['subject_matter_id'] = 716;
                }

                $data[] = $p;
            }
        }

        foreach (array_chunk($data, 2000) as $t) {
            DB::table('pricelists')->insert($t);
        }
    }
}
