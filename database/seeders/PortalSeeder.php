<?php

namespace Database\Seeders;

use App\Models\Portal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portals')->delete();

        $path = public_path('../database/dump/portals.csv');
        $portals = readCSVFile($path);

        //1113,"Akorbi","https://plunet.akorbi.com","Reutrans LTD.","Reutrans123!"
        foreach ($portals as $portal) {
            if (is_array($portal)) {
                $keys = array('id', 'name', 'url', 'username', 'password');
                $values = array_values($portal);

                $p = array_combine($keys, $values);
                $p['created_at'] = '2022-09-19 22:47:09';
                $p['updated_at'] = '2022-09-19 22:47:09';

                DB::table('portals')->insert($p);
            }
        }
    }
}
