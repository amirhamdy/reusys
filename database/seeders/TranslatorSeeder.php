<?php

namespace Database\Seeders;

use App\Models\Translator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();

        // "id","name","degree","gender","date_of_birth","nationality","experience","id_number","vat_number","id_other","timezone","website","skype","address","city","postal_code","payment_after","nda","cv","translator_type_id","native_language_id","second_language_id","country_id","currency_id","created_at","updated_at"
        DB::table('translators')->delete();

        // "resource_ID","resource_rating","creator_ID","resource_country","resource_type","resource_skype","resource_website","resource_address","resource_city","resource_ZIP","status_type_ID","nda","cv","payment_after","approve","created_date"
        $resources = readCSVFile(public_path('../database/dump/resources.csv'));

        // "freelancer_ID","resource_ID","freelancer_name","degree","sex","native_language","second_native_language","birth_date","nationality","experience"
        $vendors = array();
        $vendors_data = readCSVFile(public_path('../database/dump/vendors.csv'));
        foreach ($vendors_data as $vendor) {
            if (is_array($vendor)) {
                $keys = array("freelancer_ID", "resource_ID", "freelancer_name", "degree", "sex", "native_language", "second_native_language", "birth_date", "nationality", "experience");

                $values = array_values($vendor);
                $vendors[] = array_combine($keys, $values);
            }
        }

        // "agency_ID","resource_ID","agency_name","ID_number","vat_number","ID_other","phone","time_zone"
        $agencies = array();
        $agencies_data = readCSVFile(public_path('../database/dump/agencies.csv'));
        foreach ($agencies_data as $agency) {
            if (is_array($agency)) {
                $keys = array("agency_ID", "resource_ID", "agency_name", "ID_number", "vat_number", "ID_other", "phone", "time_zone");

                $values = array_values($agency);
                $agencies[] = array_combine($keys, $values);
            }
        }

        foreach ($resources as $resource) {
            if (is_array($resource)) {
                $keys = array("resource_ID", "resource_rating", "creator_ID", "resource_country", "resource_type", "resource_skype", "resource_website", "resource_address", "resource_city", "resource_ZIP", "status_type_ID", "nda", "cv", "payment_after", "approve", "created_date");

                $values = array_values($resource);
                $r = array_combine($keys, $values);

                // r = "resource_ID","resource_rating","creator_ID","resource_country","resource_type","resource_skype","resource_website","resource_address","resource_city","resource_ZIP","status_type_ID","nda","cv","payment_after","approve","created_date"
                // v = "freelancer_ID","resource_ID","freelancer_name","degree","sex","native_language","second_native_language","birth_date","nationality","experience"
                // a = "agency_ID","resource_ID","agency_name","ID_number","vat_number","ID_other","phone","time_zone"

                if ($r['resource_type'] === 'Vendor') {
                    // find the vendor
                    $vendor = $this->find_resource($vendors, $r['resource_ID']);
                    if ($vendor) {
                        $input = array(
                            'id' => $r['resource_ID'],
                            'name' => $vendor['freelancer_name'],
                            'degree' => $vendor['degree'],
                            'gender' => $vendor['sex'] == 'male' ? 'Male' : 'Female',
                            'date_of_birth' => $vendor['birth_date'] == '0000-00-00' ? '1990-01-01' : $vendor['birth_date'],
                            'nationality' => $vendor['nationality'],
                            'experience' => $vendor['experience'],
                            'id_number' => null,
                            'vat_number' => null,
                            'id_other' => null,
                            'timezone' => null,
                            'website' => $r['resource_website'],
                            'skype' => $r['resource_skype'],
                            'address' => $r['resource_address'],
                            'city' => $r['resource_city'],
                            'postal_code' => null,
                            'payment_after' => $r['payment_after'],
                            'nda' => $r['nda'] ? 1 : 0,
                            'cv' => $r['cv'] ? 1 : 0,
                            'translator_type_id' => 1,
                            'native_language' => null,
                            'second_language' => null,
                            'country_id' => $r['resource_country'],
                            'currency_id' => 1,
                            'created_at' => $r['created_date'],
                            'updated_at' => $r['created_date'],
                        );
                        $data[] = $input;
                    } else {
                        echo "\n\n\n" . $r['resource_ID'] . "\n\n\n";
                    }
                } else {
                    // find the agency
                    $agency = $this->find_resource($agencies, $r['resource_ID']);
                    if ($agency) {
                        $input = array(
                            'id' => $r['resource_ID'],
                            'name' => $agency['agency_name'],
                            'degree' => null,
                            'gender' => null,
                            'date_of_birth' => null,
                            'nationality' => null,
                            'experience' => null,
                            'id_number' => $agency['ID_number'],
                            'vat_number' => $agency['vat_number'],
                            'id_other' => $agency['ID_other'],
                            'timezone' => $agency['time_zone'],
                            'website' => $r['resource_website'],
                            'skype' => $r['resource_skype'],
                            'address' => $r['resource_address'],
                            'city' => $r['resource_city'],
                            'postal_code' => null,
                            'payment_after' => $r['payment_after'],
                            'nda' => $r['nda'] ? 1 : 0,
                            'cv' => $r['cv'] ? 1 : 0,
                            'translator_type_id' => 2,
                            'native_language' => null,
                            'second_language' => null,
                            'country_id' => $r['resource_country'],
                            'currency_id' => 1,
                            'created_at' => $r['created_date'],
                            'updated_at' => $r['created_date'],
                        );
                        $data[] = $input;
                    } else {
                        echo "\n\n\n" . $r['resource_ID'] . "\n\n\n";
                    }

                }

//                DB::table('translators')->insert($r);
            }
        }

        DB::table('translators')->insert($data);
    }

    public function find_resource($resources, $id)
    {
        $found = null;

        foreach ($resources as $resource) {
            if ($resource['resource_ID'] == $id) {
                $found = $resource;
            }
        }

        return $found;
    }
}
