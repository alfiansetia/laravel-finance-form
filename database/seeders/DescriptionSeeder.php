<?php

namespace Database\Seeders;

use App\Models\DescriptionModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DescriptionModel::truncate();

        $datas = [
            [
                "value" => "Description 1",
                "price" => 1000,
                "id_payment_request" => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "value" => "Description 2",
                "price" => 1000,
                "id_payment_request" => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DescriptionModel::insert($datas);
    }
}
