<?php

namespace Database\Seeders;

use App\Models\Validator;
use Illuminate\Database\Seeder;

class ValidatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Validator::create([
            'prepared_by'   => 'Vivi Lie',
            'checked_by'    => 'Djajadi',
            'approved_by'   => 'Darren Chan',
        ]);
    }
}
