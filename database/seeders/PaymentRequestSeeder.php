<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\FinanceModel;
use App\Models\PaymentRequestModel;
use App\Models\Vendor;
use Carbon\Carbon;
use Faker\Factory;
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
        $vendors = Vendor::all();
        $banks = Bank::all();

        $currency = ['idrtoidr', 'idrtosgd', 'idrtousd', 'usdtousd'];

        for ($i = 0; $i < 20; $i++) {
            $rand = rand(0, 3);
            $status = rand(1, 4);
            $bank = $banks->random();
            $payment = PaymentRequestModel::factory()->create([
                'no_pr'         => $i,
                'bank_id'       => $bank->id,
                'id_division'   => $bank->division_id,
                'vendor_id'     => $vendors->random(),
                'status_id'     => $status,
                'paid_date'     => $status == 4 ? now() : null,
                'currency'      => $currency[$rand],
            ]);

            for ($j = 0; $j < 2; $j++) {
                DescriptionModel::factory()->create([
                    'id_payment_request'    => $payment->id,
                    'type'                  => 'reg'
                ]);
            }
            for ($k = 0; $k < 2; $k++) {
                DescriptionModel::factory()->create([
                    'id_payment_request'    => $payment->id,
                    'type'                  => 'add'
                ]);
            }
        }
    }
}
