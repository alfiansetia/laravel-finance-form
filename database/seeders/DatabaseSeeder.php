<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DivisionSeeder::class,
            VendorSeeder::class,
            BankSeeder::class,
            UsersSeeder::class,
            StatusSeeder::class,
            WhtSeeder::class,
            VatSeeder::class,
        ]);
    }
}
