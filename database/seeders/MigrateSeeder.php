<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\DebitNoteModel;
use App\Models\DescriptionDebitModel;
use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\PaymentRequestModel;
use App\Models\Status;
use App\Models\User;
use App\Models\Vat;
use App\Models\Vendor;
use App\Models\Wht;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MigrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->restore();
    }

    public function backup()
    {
        $file = public_path('db.json');
        $data['user'] = User::all();
        $data['bank'] = Bank::all();
        $data['vendor'] = Vendor::all();
        $data['status'] = Status::all();

        $data['divisi'] = DivisionModel::all();
        $data['vat'] = Vat::all();
        $data['wht'] = Wht::all();

        $data['pr'] = PaymentRequestModel::all();
        $data['pr_Desc'] = DescriptionModel::all();
        $data['dn'] = DebitNoteModel::all();
        $data['dn_desc'] = DescriptionDebitModel::all();


        File::put($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function restore()
    {
        $this->call([
            ValidatorSeeder::class
        ]);

        $data = json_decode(file_get_contents(public_path('db.json')), true);
        foreach ($data['user'] as $item) {
            User::create($item);
        }
        foreach ($data['divisi'] as $item) {
            DivisionModel::create($item);
        }
        foreach ($data['vendor'] as $item) {
            Vendor::create($item);
        }
        foreach ($data['bank'] as $item) {
            Bank::create($item);
        }
        foreach ($data['status'] as $item) {
            Status::create($item);
        }
        foreach ($data['vat'] as $item) {
            Vat::create($item);
        }
        foreach ($data['wht'] as $item) {
            Wht::create($item);
        }
        foreach ($data['pr'] as $item) {
            $param_pr = [
                'id'                => $item['id'],
                'invoice_date'      => $item['invoice_date'],
                'received_date'     => $item['received_date'],
                'contract'          => $item['contract'],
                'date_pr'           => $item['date_pr'],
                'no_pr'             => $item['no_pr'],
                'id_division'       => $item['id_division'],
                'for'               => $item['for'],
                'due_date'          => $item['due_date'],
                'bank_charge'       => $item['bank_charge'],
                'currency'          => $item['currency'],
                'wht_id'            => $item['wht_id'],
                'vat_id'            => $item['vat'] == 0 ? null : 1,
                'bank_id'           => $item['bank_id'],
                'vendor_id'         => $item['vendor_id'],
                'status_id'         => $item['status_id'],
                'validator_id'      => 1,
                'note'              => $item['note'],
                'paid_date'         => $item['paid_date'],
            ];
            PaymentRequestModel::create($param_pr);
        }
        foreach ($data['pr_Desc'] as $item) {
            $param_pr_desc = [
                'id'                    => $item['id'],
                'value'                 => $item['value'],
                'price'                 => $item['price'],
                'id_payment_request'    => $item['id_payment_request'],
                // 'vat_id'                => 1,
                // 'wht_id'                => $item['wht_id'],
                // 'pr_serial'             => $item['pr_serial'],
                // 'tax_date'              => $item['tax_date'],
            ];
            DescriptionModel::create($param_pr_desc);
        }

        foreach ($data['dn'] as $item) {
            $param_dn = [
                'id'                    => $item['id'],
                'no_invoice'            => $item['no_invoice'],
                'invoice_date'          => $item['invoice_date'],
                'tax_invoice_serial_no' => $item['tax_invoice_serial_no'],
                'tax_invoice_date'      => $item['tax_invoice_date'],
                'no_debit_note'         => $item['no_debit_note'],
                'id_division'           => $item['id_division'],
                'for'                   => $item['for'],
                'bank_charge'           => $item['bank_charge'],
                'received_from'         => $item['received_from'],
                'debit_note_date'       => $item['debit_note_date'],
                'currency'              => $item['currency'],
                'wht_id'                => $item['wht_id'],
                'vat_id'                => $item['vat'] == 0 ? null : 1,
                'bank_id'               => $item['bank_id'],
                'status_id'             => $item['status_id'],
                'validator_id'          => 1,
                'wht_no'                => $item['wht_no'],
                'wht_date'              => $item['wht_date'],
                'note'                  => $item['note'],
                'paid_date'             => $item['paid_date'],
            ];
            DebitNoteModel::create($param_dn);
        }
        foreach ($data['dn_desc'] as $item) {
            $param_dn_desc = [
                'id'                    => $item['id'],
                'value'                 => $item['value'],
                'price'                 => $item['price'],
                'id_debit_note'         => $item['id_debit_note'],
                // 'vat_id'                => 1,
                // 'wht_id'                => $item['wht_id'],
                // 'pr_serial'             => $item['pr_serial'],
                // 'tax_date'              => $item['tax_date'],
            ];
            DescriptionDebitModel::create($param_dn_desc);
        }
    }
}
