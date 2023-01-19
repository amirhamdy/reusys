<?php

namespace Database\Seeders;

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

        // contact_ID,agency_ID,contact,phone,mail,position
        $agency_contacts = array();
        $agency_contacts_data = readCSVFile(public_path('../database/dump/agency_contacts.csv'));
        foreach ($agency_contacts_data as $a_c) {
            if (is_array($a_c)) {
                $keys = array("contact_ID", "agency_ID", "contact", 'phone', 'mail', 'position');
                $values = array_values($a_c);
                $agency_contacts[] = array_combine($keys, $values);
            }
        }

        // ID,freelancer_ID,phone
        $vendor_phones = array();
        $freelancer_phones = readCSVFile(public_path('../database/dump/freelancer_phone.csv'));
        foreach ($freelancer_phones as $v_phone) {
            if (is_array($v_phone)) {
                $keys = array("ID", "freelancer_ID", "phone");
                $values = array_values($v_phone);
                $vendor_phones[] = array_combine($keys, $values);
            }
        }

        // ID,freelancer_ID,mail
        $vendor_emails = array();
        $freelancer_emails = readCSVFile(public_path('../database/dump/freelancer_mail.csv'));
        foreach ($freelancer_emails as $v_email) {
            if (is_array($v_email)) {
                $keys = array("ID", "freelancer_ID", "mail");
                $values = array_values($v_email);
                $vendor_emails[] = array_combine($keys, $values);
            }
        }

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

        $phones = array();
        $emails = array();
        $contacts = array();

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

                        // find the vendor phones
                        $vendor_phones_arr = $this->find_phones($vendor_phones, $vendor['freelancer_ID']);
                        if (count($vendor_phones_arr) > 0) {
                            foreach ($vendor_phones_arr as $phone) {
                                $phone_input = array(
                                    'id' => $phone['ID'],
                                    'number' => $phone['phone'],
                                    'translator_id' => $r['resource_ID'],
                                    'created_at' => $r['created_date'],
                                    'updated_at' => $r['created_date'],
                                );
                                $phones[] = $phone_input;
                            }
                        }

                        // find the vendor emails
                        $vendor_emails_arr = $this->find_emails($vendor_emails, $vendor['freelancer_ID']);
                        if (count($vendor_emails_arr) > 0) {
                            foreach ($vendor_emails_arr as $email) {
                                $email_input = array(
                                    'id' => $email['ID'],
                                    'address' => $email['mail'],
                                    'translator_id' => $r['resource_ID'],
                                    'created_at' => $r['created_date'],
                                    'updated_at' => $r['created_date'],
                                );
                                $emails[] = $email_input;
                            }
                        }
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

                        // find the agency contacts
                        $agency_contacts_arr = $this->find_contacts($agency_contacts, $agency['agency_ID']);
                        if (count($agency_contacts_arr) > 0) {
                            foreach ($agency_contacts_arr as $contact) {
                                $contact_input = array(
                                    //contact_ID,agency_ID,contact,phone,mail,position
                                    'id' => $contact['contact_ID'],
                                    'name' => $contact['contact'],
                                    'phone' => $contact['phone'],
                                    'email' => $contact['mail'],
                                    'position' => $contact['position'],
                                    'translator_id' => $r['resource_ID'],
                                    'created_at' => $r['created_date'],
                                    'updated_at' => $r['created_date'],
                                );
                                $contacts[] = $contact_input;
                            }
                        }
                    } else {
                        echo "\n\n\n" . $r['resource_ID'] . "\n\n\n";
                    }
                }

//                DB::table('translators')->insert($r);
            }
        }

        DB::table('translators')->insert($data);
        DB::table('phones')->insert($phones);
        DB::table('emails')->insert($emails);
        DB::table('contacts')->insert($contacts);
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

    public function find_phones($phones, $id)
    {
        $found = [];

        foreach ($phones as $phone) {
            if ($phone['freelancer_ID'] == $id) {
                $found[] = $phone;
            }
        }

        return $found;
    }

    public function find_emails($emails, $id)
    {
        $found = [];

        foreach ($emails as $email) {
            if ($email['freelancer_ID'] == $id) {
                $found[] = $email;
            }
        }

        return $found;
    }

    public function find_contacts($contacts, $id)
    {
        $found = [];

        foreach ($contacts as $contact) {
            if ($contact['agency_ID'] == $id) {
                $found[] = $contact;
            }
        }

        return $found;
    }
}
