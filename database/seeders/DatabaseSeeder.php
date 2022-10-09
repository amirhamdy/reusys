<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
//        $user = \App\Models\User::factory()
//            ->count(1)
//            ->create([
//                'email' => 'admin@admin.com',
//                'password' => Hash::make('password'),
//            ]);

        $this->call(ContactSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(CustomerRatingSeeder::class);
        $this->call(CustomerStatusSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(JobTypeSeeder::class);
        $this->call(JobUnitSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(OpportunitySeeder::class);
        $this->call(OpportunityTypeSeeder::class);
        $this->call(OpportunityUnitSeeder::class);
        $this->call(PortalSeeder::class);
        $this->call(PricebookSeeder::class);
        $this->call(PricelistSeeder::class);
        $this->call(ProductlineSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(SubjectMatterSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(TaskStatusSeeder::class);
        $this->call(TaskTypeSeeder::class);
        $this->call(TaskUnitSeeder::class);
        $this->call(TranslatorTypeSeeder::class);
        $this->call(TranslatorSeeder::class);
        $this->call(TranslatorPriceListSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);
//        $this->call(\SqlFileSeeder::class);
    }
}
