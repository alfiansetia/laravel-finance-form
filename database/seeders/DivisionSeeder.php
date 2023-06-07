<?php

namespace Database\Seeders;

use App\Models\DivisionModel;
use App\Models\MenuModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DivisionModel::truncate();

        $datas = [
            [
                "name" => "PT. ESR INDONESIA MANAGEMENT",
                "slug" => "EIM-PR",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "PT. ESR INDONESIA HOLDINGS",
                "slug" => "EIH-PR",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "PT. ESR INDONESIA PROPERTIES ONE",
                "slug" => "EIPO-PR",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "PT. ESR INDONESIA PROPERTIES TWO",
                "slug" => "EIPT-PR",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "PT. ESR INDONESIA PROPERTIES THREE",
                "slug" => "EIPTh-PR",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DivisionModel::insert($datas);
    }
}
