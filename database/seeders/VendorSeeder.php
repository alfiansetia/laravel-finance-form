<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'beneficary' => 'PT JAYA',
            'bank'       => 'BRI 1234566789'
        ]);

        Vendor::create([
            'beneficary' => 'PT JAYA',
            'bank'       => 'BCA 1234566789'
        ]);

        Vendor::create([
            'beneficary' => 'PT MAKMUR',
            'bank'       => 'BRI 1234566789'
        ]);

        Vendor::create([
            'beneficary' => 'PT MAKMUR',
            'bank'       => 'BNI 1234566789'
        ]);
    }
}
