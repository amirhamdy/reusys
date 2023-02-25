<?php

namespace Database\Seeders;

use App\Models\InvoiceJob;
use Illuminate\Database\Seeder;

class InvoiceJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceJob::factory()
            ->count(5)
            ->create();
    }
}
