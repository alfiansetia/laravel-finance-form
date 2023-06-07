<?php

namespace Database\Seeders;

use App\Models\Wht;
use Illuminate\Database\Seeder;

class WhtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wht::create([
            'name' => 'WHT 21',
            'value' => 2,
        ]);
        Wht::create([
            'name' => 'WHT 22',
            'value' => 3,
        ]);
    }
}
