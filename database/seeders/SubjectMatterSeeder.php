<?php

namespace Database\Seeders;

use App\Models\SubjectMatter;
use Illuminate\Database\Seeder;

class SubjectMatterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubjectMatter::factory()
            ->count(5)
            ->create();
    }
}
