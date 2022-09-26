<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->delete();

        $path = public_path('../database/dump/customers.csv');
        $customers = readCSVFile($path);

        //1000020,"LUZ Inc.","","","","www.luz.com","555 Montgomery St., Suite 720, ","CA 94111","San Francisco","555 Montgomery St., Suite 720, San Francisco, CA 94111",1000,1000,1017,"Good","Customer","2016-11-30 04:36:16","2022-09-21 22:03:00"
        foreach ($customers as $customer) {
            if (is_array($customer)) {
                $keys = array('id', 'name', 'phone', 'email', 'fax', 'website', 'address', 'postal_code', 'city', 'billing_address', 'country_id', 'region_id', 'industry_id', 'customer_rating_id', 'customer_status_id', 'created_at', 'updated_at');

                $values = array_values($customer);
                $c = array_combine($keys, $values);

                // change customer rating from str to ID
                switch ($c['customer_rating_id']) {
                    case 'Excellent':
                        $c['customer_rating_id'] = 1;
                        break;
                    case 'Good':
                        $c['customer_rating_id'] = 2;
                        break;
                    case 'Poor':
                        $c['customer_rating_id'] = 3;
                        break;
                    case 'Not Interested':
                        $c['customer_rating_id'] = 4;
                        break;
                    case 'Dead':
                        $c['customer_rating_id'] = 5;
                        break;
                    default:
                        $c['customer_rating_id'] = 1;
                        break;
                }

                // change customer status from str to ID
                switch ($c['customer_status_id']) {
                    case 'Lead':
                        $c['customer_status_id'] = 1;
                        break;
                    case 'Prospect':
                        $c['customer_status_id'] = 2;
                        break;
                    case 'Customer':
                        $c['customer_status_id'] = 3;
                        break;
                    default:
                        $c['customer_status_id'] = 3;
                        break;
                }

                DB::table('customers')->insert($c);
            } else {
                print_r($customer);
                print_r('DONE!');
            }
        }
    }
}
