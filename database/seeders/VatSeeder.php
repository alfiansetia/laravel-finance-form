<?php

namespace Database\Seeders;

use App\Models\Vat;
use Illuminate\Database\Seeder;

class VatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vat::create([
            'name'  => 'VAT 11',
            'value' => 11
        ]);

        Vat::create([
            'name'  => 'VAT 12',
            'value' => 12
        ]);
    }
}
