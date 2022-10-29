<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectMatterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_matters')->delete();

        DB::table('subject_matters')->insert([
            ['id' => 700, 'name' => 'Advertising & Marketing', 'created_at' => '2016-10-31 09:21:59', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 701, 'name' => 'Aerospace', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 702, 'name' => 'Agriculture', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 703, 'name' => 'Arts & Entertainment', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 704, 'name' => 'Banking & Finance', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 705, 'name' => 'Books & Publishing', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 706, 'name' => 'Business Services', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 707, 'name' => 'Computer Games', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 708, 'name' => 'Constructions & Building Materials', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 709, 'name' => 'Consumer Electronics', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 710, 'name' => 'Customer Support', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 711, 'name' => 'Desktop Publishing', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 712, 'name' => 'Electronics', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 713, 'name' => 'Engineering', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 714, 'name' => 'Film & Video', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 715, 'name' => 'Food & Beverages', 'created_at' => '2016-11-09 13:09:44', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 716, 'name' => 'General', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 717, 'name' => 'Graphics', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 718, 'name' => 'Hospitality', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 719, 'name' => 'Insurance', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 720, 'name' => 'Legal', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 721, 'name' => 'Life Science', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 722, 'name' => 'Medical & Pharmaceuticals', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 723, 'name' => 'Other', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 724, 'name' => 'Public Sector & Governmental', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 725, 'name' => 'Real Estate', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 726, 'name' => 'Sports', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 727, 'name' => 'Telecommunications', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 728, 'name' => 'Televisions & Broadcasting', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 729, 'name' => 'Textile', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 730, 'name' => 'Transportations', 'created_at' => '2016-11-09 13:12:07', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 731, 'name' => 'Trucks & Heavy Equipment', 'created_at' => '2016-11-09 13:12:18', 'updated_at' => '2022-09-19 22:47:09'],
        ]);
    }
}
