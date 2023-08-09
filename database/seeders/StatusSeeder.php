<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status1 = Status::create([
            'name'  => 'Pending Approval',
            'color' => 'orange',
        ]);

        $status2 = Status::create([
            'name'  => 'Processing',
            'color' => 'orange',
        ]);

        $status3 =  Status::create([
            'name'  => 'Reject',
            'color' => 'red',
        ]);

        $status4 = Status::create([
            'name'  => 'Paid',
            'color' => 'green',
        ]);
    }
}
