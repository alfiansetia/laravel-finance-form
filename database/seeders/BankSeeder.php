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
            'BRI 12345678',
            'BNI 12345678',
            'MANDIRI 12345678',
            'BCA 12345678',
        ];
        foreach ($name as $item) {
            for ($i = 1; $i < 5; $i++) {
                Bank::create([
                    'name'          => $item,
                    'division_id'   => $i,
                ]);
            }
        }
    }
}
