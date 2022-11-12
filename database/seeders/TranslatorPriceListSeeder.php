<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslatorPriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translator_price_lists')->delete();

        $data = array();
        $path = public_path('../database/dump/resource_price_list.csv');
        $prices = readCSVFile($path);

        //list_ID,created_date,unit_price,currency_ID,source_language_ID,target_language_ID,task_type_ID,creator_ID,resource_ID,unit_ID,sub_matter_ID,minimum_charge
        foreach ($prices as $price) {
            if (is_array($price)) {
                $keys = array('id', 'created_at', 'unit_price', 'currency_id', 'source_language_id', 'target_language_id', 'task_type_id', 'creator_ID', 'translator_id', 'task_unit_id', 'subject_matter_id', 'minimum_charge');

                $values = array_values($price);
                $c = array_combine($keys, $values);

                unset($c['creator_ID']);
                $c['updated_at'] = $c['created_at'];
                if ($c['task_unit_id'] == 0) {
                    $c['task_unit_id'] = 339;
                }

                $data[] = $c;
            }
        }

        foreach (array_chunk($data, 2000) as $t) {
            DB::table('translator_price_lists')->insert($t);
        }
    }
}
