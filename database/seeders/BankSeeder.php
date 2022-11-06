<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->delete();

        DB::table('banks')->insert([
            ['id' => 1, 'name' => 'Community Federal Savings Bank', 'label' => 'USD Account', 'account_name' => 'Reutrans LTD', 'account_number' => '8114422129', 'routing_number' => '26073150', 'country_id' => 1000, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2016-11-05 00:36:57'],
            ['id' => 2, 'name' => 'Wirecard', 'label' => 'Euro Account - Wirecard', 'account_name' => 'Reutrans LTD', 'account_number' => 'WIREDEMM', 'routing_number' => 'DE55512308006500191760', 'country_id' => 1093, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2016-11-03 00:36:57'],
            ['id' => 3, 'name' => 'Barclays', 'label' => 'GBP Account', 'account_name' => 'Reutrans LTD', 'account_number' => '00126459', 'routing_number' => '231486', 'country_id' => 1216, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2016-11-01 00:36:57'],
            ['id' => 4, 'name' => 'Commercial International Bank - CIB', 'label' => 'Personal EGP', 'account_name' => 'MOHAMED FATHY MOHAMED ABOUELNASR', 'account_number' => '100028265586', 'routing_number' => 'CIBEEGCX053', 'country_id' => 1081, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2017-02-21 12:23:35'],
            ['id' => 5, 'name' => 'Commercial International Bank - CIB', 'label' => 'Personal USD', 'account_name' => 'MOHAMED FATHY MOHAMED ABOUELNASR', 'account_number' => '100027230541', 'routing_number' => 'CIBEEGCX053', 'country_id' => 1081, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2017-02-21 12:24:39'],
            ['id' => 6, 'name' => 'Commercial International Bank - CIB', 'label' => 'CIB Egypt EGP', 'account_name' => 'Reutrans Company', 'account_number' => '100034198548', 'routing_number' => 'CIBEEGCX109', 'country_id' => 1081, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2018-03-26 18:19:49'],
            ['id' => 7, 'name' => 'Commercial International Bank - CIB', 'label' => 'CIB Egypt USD', 'account_name' => 'Reutrans Company', 'account_number' => '100034198588', 'routing_number' => 'CIBEEGCX109', 'country_id' => 1081, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2018-03-26 18:20:40'],
            ['id' => 8, 'name' => 'CASH', 'label' => 'CASH', 'account_name' => 'CASH', 'account_number' => 'CASH', 'routing_number' => 'CASH', 'country_id' => 1081, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2018-03-26 18:21:06'],
            ['id' => 9, 'name' => 'PayPal', 'label' => 'PayPal', 'account_name' => 'info@reutrans.com', 'account_number' => 'PayPal', 'routing_number' => 'PayPal', 'country_id' => 1081, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2018-03-26 18:21:35'],
            ['id' => 10, 'name' => 'Citibank', 'label' => 'Euro Account - Citibank', 'account_name' => 'Reutrans LTD.', 'account_number' => 'IE88CITI99005170059653', 'routing_number' => 'CITIIE2X', 'country_id' => 1109, 'created_at' => '2016-09-19 22:47:09', 'updated_at' => '2021-02-02 13:05:57'],
        ]);
    }


}
