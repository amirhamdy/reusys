<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();

        $path = public_path('../database/dump/projects.csv');
        $projects = readCSVFile($path);

        //2000032,"161-J2030A-PFAP","2016-09-14","2016-09-22","1BR28491",8000032,"2016-11-30 07:57:33"
        foreach ($projects as $project) {
            if (is_array($project)) {
                $keys = array('id', 'name', 'start_date', 'end_date', 'po_number', 'productline_id', 'created_at');

                $values = array_values($project);
                $p = array_combine($keys, $values);
                $p['updated_at'] = $p['created_at'];

                DB::table('projects')->insert($p);
            }
        }
    }
}
