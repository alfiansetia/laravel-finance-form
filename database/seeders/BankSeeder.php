<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'BRI',
            'BNI',
            'MANDIRI',
            'BCA',
        ];
        foreach ($name as $item) {
            Bank::create([
                'name' => $item
            ]);
        }
    }
}
