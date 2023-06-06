<?php

namespace Database\Seeders;

use App\Models\FinanceModel;
use App\Models\PaymentRequestModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentRequestModel::truncate();

        $datas = [
            [
                'invoice_date' => Carbon::now()->format('Y-m-d'),
                'received_date' => Carbon::now()->format('Y-m-d'),
                "contract" => "contract",
                'date_pr' => Carbon::now()->format('Y-m-d'),
                "no_pr" => "no_pr_voucher",
                "id_division" => 1,
                "name_beneficiary" => "name_beneficiary",
                "bank_account" => "bank_account",
                "for" => "for",
                "result_vat" => 5000,
                "total_wht" => 5000,
                "result_wht" => 5000,
                "beneficiary_bank" => "beneficiary_bank",
                "due_date" => 1,
                'deadline' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        PaymentRequestModel::insert($datas);
    }
}
