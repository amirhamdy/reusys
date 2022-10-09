<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            ['id' => 999998, 'name' => 'System Admin', 'email' => 'portal@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-24', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 999999, 'name' => 'Amir Hamdy', 'email' => 'amir@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2017-04-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000000, 'name' => 'Mohamed Abouelnasr', 'email' => 'm.abouelnasr@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2015-01-06', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000001, 'name' => 'Martin Davis', 'email' => 'm.davis@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Misr', 'hiring_date' => '2016-11-29', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000002, 'name' => 'Rachel Stevenson', 'email' => 'r.stevenson@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-17', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000003, 'name' => 'Riccardo Pozzoli', 'email' => 'recruitment@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-01', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000004, 'name' => 'Ibrahem Robil', 'email' => 'ibrahem.robil1994@gmail.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2017-07-19', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000007, 'name' => 'Hannah Pearson', 'email' => 'projects@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-01', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000008, 'name' => 'Matt Brooks', 'email' => 'accounting@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000009, 'name' => 'Mae Adel', 'email' => 'm.hemida@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000010, 'name' => 'Kate Wright', 'email' => 'kate@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000011, 'name' => 'Aaron Reynolds', 'email' => 'support@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000012, 'name' => 'Craig Adams', 'email' => 'craig@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000013, 'name' => 'Ian Lawson', 'email' => 'ian@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000016, 'name' => 'Sarah Ismail', 'email' => 'cairo.office@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2016-11-20', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000017, 'name' => 'Yasser Mansour', 'email' => 'y.mansour@reutrans.com	', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2017-04-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000018, 'name' => 'Amera El-Hady', 'email' => 'user@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2017-04-09', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000020, 'name' => 'Shady Nagy', 'email' => 'sh.nagy@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2017-07-20', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000021, 'name' => 'Eman Fathy', 'email' => 'e.fathy@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2017-07-20', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000022, 'name' => 'Amal Ramadan', 'email' => 'a.ramadan@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo', 'hiring_date' => '2017-09-25', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000023, 'name' => 'Mohamed  El-Kotb', 'email' => 'm.kotb@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2018-03-19', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000024, 'name' => 'Asma Youssef', 'email' => 'a.youssef@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2018-04-11', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000025, 'name' => 'Afnan Tajjudieen', 'email' => 'a.tajjudieen@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2018-05-01', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000026, 'name' => 'Israa Elsayed', 'email' => 'i.elsayed@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2018-05-01', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000027, 'name' => 'Ahmed Fayed', 'email' => 'a.fayed@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2018-05-01', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000028, 'name' => 'Mohamed Adel', 'email' => 'm.adel@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2018-08-06', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000029, 'name' => 'Mai Nabgha', 'email' => 'm.nabgha@reutrans.com', 'password' => Hash::make('password'), 'address' => '6 Sayed Zakaria - Masaken Sheraton - Cairo', 'hiring_date' => '2018-09-10', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000030, 'name' => 'Mohamed Zaki', 'email' => 'm.zaki@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Egypt', 'hiring_date' => '2019-07-16', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000031, 'name' => 'Mohamed Zakaria', 'email' => 'mohamed.zakaria@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Ahmed El-Sawy Str. 55, Nasr City, Kairo, Ägypten.', 'hiring_date' => '2019-08-12', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000032, 'name' => 'Mohamed Zakaria', 'email' => 'm.zakaria@reutrans.com', 'password' => Hash::make('password'), 'address' => '55 Ahmed Elsawy, Nasr City', 'hiring_date' => '2019-08-12', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000033, 'name' => 'maria seety samir', 'email' => 'm.seety@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo, Egypt', 'hiring_date' => '2019-08-14', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000034, 'name' => 'Hend Reyad', 'email' => 'hind@apacling.com', 'password' => Hash::make('password'), 'address' => 'Cairo,Egypt', 'hiring_date' => '2019-08-14', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000035, 'name' => 'Ahmed Hisham', 'email' => 'ahmad@apacling.com', 'password' => Hash::make('password'), 'address' => 'Cairo,Egypt', 'hiring_date' => '2019-08-14', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000036, 'name' => 'Zeinab khalil', 'email' => 'z.maher@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo,Egypt', 'hiring_date' => '2019-08-14', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000037, 'name' => 'Engy Ezzat', 'email' => 'e.ezzat@reutrans.com', 'password' => Hash::make('password'), 'address' => 'Cairo,Egypt', 'hiring_date' => '2019-09-05', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],
            ['id' => 1000038, 'name' => 'Chris Adams', 'email' => 'c.adams@reutrans.com', 'password' => Hash::make('password'), 'address' => '44 Hisham Labib, Nasr City', 'hiring_date' => '2022-01-03', 'created_at' => '2022-09-19 22:47:09', 'updated_at' => '2022-09-19 22:47:09'],]);
    }
}
