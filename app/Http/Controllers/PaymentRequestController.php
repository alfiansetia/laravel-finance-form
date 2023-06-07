<?php

namespace App\Http\Controllers;

use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\PaymentRequestModel;
use App\Models\Wht;
// use Barryvdh\DomPDF\PDF;
use CURLFile;
use DateTime;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Extension\DescriptionList\Node\DescriptionTerm;
use PDF;


class PaymentRequestController extends Controller
{

    private $title = 'Payment Request';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = $this->title;
        $data = PaymentRequestModel::all();
        $desc = DescriptionModel::all();
        return view('payment_request.index', compact('data', 'desc'))->with(['title' => $this->title]);
    }


    public function create()
    {
        $wht = Wht::get();
        $division = DivisionModel::all();
        return view('payment_request.add', compact('division', 'wht'))->with(['title' => $this->title]);
    }

    public function show(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $payment = $payment;
        if (!$payment) {
            abort(404);
        }
        $desc  = DescriptionModel::where('id_payment_request', $payment->id)->get();
        $divition  = DivisionModel::where('id', $payment->id_division)->first();
        return view('payment_request.detail', compact('desc', 'divition', 'payment'));
    }

    public function edit(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $wht = Wht::get();
        $division = DivisionModel::all();
        $data = PaymentRequestModel::find($payment->id);
        $desc = DescriptionModel::where('id_payment_request', $data->id)->get();

        $total_description = 0;

        foreach ($desc as $key => $value) {
            $total_description = $total_description + $value->price;
        }
        return view('payment_request.edit', compact('division', 'data', 'desc', 'total_description', 'wht'))->with(['title' => $this->title]);
    }

    public function update(Request $request, PaymentRequestModel $payment)
    {
        $title = $this->title;
        $dateTime = new DateTime($request->date_pr);

        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $month = $carbonDate->month;


        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $year = $carbonDate->year;

        // $count =
        //     PaymentRequestModel::where('id_division', $request->id_division)
        //     ->whereYear('date_pr', $year)
        //     ->whereMonth('date_pr', $month)
        //     ->count() + 1;


        $data = PaymentRequestModel::findOrFail($request->id);

        $division = DivisionModel::findOrFail($request->id_division);


        $data->update([
            'contract' => $request->contract,
            'invoice_date' => $request->invoice_date,
            'received_date' => $request->received_date,
            // 'date_pr' => $request->date_pr,
            'name_beneficiary' => $request->name_beneficiary,
            'bank_account' => $request->bank_account,
            'beneficiary_bank' => $request->beneficiary_bank,
            'for' => $request->for,
            // "id_division" => $request->id_division,
            'due_date' => $request->due_date,
            // "no_pr" => $count . '/' . $division->slug . date('/m/Y', strtotime($request->date_pr)),
            "is_dolar" => $request->is_dolar,

        ]);

        $descData  = DescriptionModel::where('id_payment_request', $request->id)->get();


        foreach ($descData as $key => $value) {

            DescriptionModel::where('id', $value->id)->delete();
        }

        $total_description = 0;

        for ($i = 0; $i < count($request->description); $i++) {

            $total_description = $total_description + $request->price[$i];

            DescriptionModel::create([
                "value" => $request->description[$i],
                "price" => $request->price[$i],
                "id_payment_request" => $request->id,
            ]);
        }

        $vat = ($total_description * 11) / 100;

        $wht =  ($total_description * $request->wht) / 100;

        $result = $total_description + $vat - $wht;

        $invoice_date = \Carbon\Carbon::parse($request->invoice_date);

        $deadline = $invoice_date->addDays($request->due_date);

        PaymentRequestModel::where('id', $request->id)->update([
            'result_vat' => $vat,
            "total_wht" =>  $wht,
            "result_wht" => $result,
            'deadline' => $deadline,
            "total" => $request->bank_charge + $result
        ]);

        return redirect()->route('payment.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'vat' => 'required|in:yes,no',
        ]);
        $isWhtNull = ($request->wht == '') ? 1 : 0;

        $division = DivisionModel::findOrFail($request->id_division);

        $dateTime = new DateTime($request->date_pr);

        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $month = $carbonDate->month;


        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $year = $carbonDate->year;

        $count =
            PaymentRequestModel::where('id_division', $division->id)
            ->whereYear('date_pr', $year)
            ->whereMonth('date_pr', $month)
            ->count() + 1;

        $counti = str_pad($count, 4, '0', STR_PAD_LEFT);


        $paymentRequest = PaymentRequestModel::create([
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            "contract"          => $request->contract,
            'date_pr'           => $request->date_pr,
            "no_pr"             => $counti . '/' . $division->slug . date('/m/y', strtotime($request->date_pr)),
            "id_division"       => $request->id_division,
            "name_beneficiary"  => $request->name_beneficiary,
            "bank_account"      => $request->bank_account,
            "for"               => $request->for,
            "beneficiary_bank"  =>  $request->beneficiary_bank,
            "due_date"          => $request->due_date,
            "bank_charge"       => $request->bank_charge,
            "is_dolar"          => 0,
            "currency"          => $request->currency,
            "wht_id"            => $request->wht,
        ]);

        $total_description = 0;

        for ($i = 0; $i < count($request->description); $i++) {

            $total_description = $total_description + $request->price[$i];

            DescriptionModel::create([
                "value" => $request->description[$i],
                "price" => $request->price[$i],
                "id_payment_request" => $paymentRequest->id,
            ]);
        }

        $vat = ($total_description * 11) / 100;

        $check_wht = ($isWhtNull == 0) ? $request->wht : 0;

        $wht =  ($total_description * $check_wht) / 100;

        $result = $total_description + $vat - $wht;

        $invoice_date = \Carbon\Carbon::parse($request->invoice_date);

        $deadline = $invoice_date->addDays($request->due_date);

        PaymentRequestModel::where('id', $paymentRequest->id)->update([
            'result_vat' => $vat,
            "total_wht" =>  $wht,
            "result_wht" => $result,
            'deadline' => $deadline,
            "total" => $request->bank_charge + $result
        ]);

        return redirect()->route('payment.index');
    }

    public function delete(PaymentRequestModel $payment)
    {
        PaymentRequestModel::where('id', $payment->id)->delete();
        $descData  = DescriptionModel::where('id_payment_request', $payment->id)->get();

        foreach ($descData as $key => $value) {

            DescriptionModel::where('id', $value->id)->delete();
        }

        return redirect()->back();
    }

    public function download(PaymentRequestModel $payment)
    {
        $payment = $payment;
        if (!$payment) {
            abort(404);
        }
        $desc  = DescriptionModel::where('id_payment_request', $payment->id)->get();
        $divition  = DivisionModel::where('id', $payment->id_division)->first();
        $pdf = PDF::loadview('payment_request.download', ['desc' => $desc, 'divition' => $divition, 'payment' => $payment]);
        return $pdf->download($payment->id . '_' . date('ymdHis') . '.pdf');
    }


    public function print(PaymentRequestModel $paymentRequestModel)
    {
        $payment = PaymentRequestModel::find($paymentRequestModel->id);
        if (!$payment) {
            abort(404);
        }

        $desc  = DescriptionModel::where('id_payment_request', $paymentRequestModel->id)->get();
        $divition  = DivisionModel::where('id', $payment->id_division)->first();

        return view('detail', compact('payment', 'desc', 'divition'));


        $jsonString  = PaymentRequestModel::find($paymentRequestModel->id);
        $data = json_decode($jsonString, true);


        $descData  = DescriptionModel::where('id_payment_request', $paymentRequestModel->id)->get();

        $div  = DivisionModel::where('id', $jsonString->id_division)->first();
        $divData = json_decode($div, true);

        $description = [];

        foreach ($descData as $key => $value) {

            if ($jsonString->is_dolar == 1) {
                array_push($description, ['description' =>   $value->value, 'price' => '$' . $value->price]);
            } else {
                array_push(
                    $description,
                    ['description' =>   $value->value, 'price' => 'Rp' . $value->price]
                );
            }
        }

        if (count($description) < 4) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        } else {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templateMore4.docx');
            echo false;
        }

        $templateProcessor->setValues(
            $data,
        );

        $templateProcessor->setValues(
            $divData,
        );

        // $templateProcessor->setValue('date_pr_convert', date('d-M-Y', strtotime($jsonString->date_pr)));
        // $templateProcessor->setValue('invoice_date_convert', date('d-M-Y', strtotime($jsonString->invoice_date)));
        // $templateProcessor->setValue('deadline_convert', date('d-M-Y', strtotime($jsonString->deadline)));

        $templateProcessor->setValue('date_pr_convert', date('d-M-y', strtotime($jsonString->date_pr)));
        $templateProcessor->setValue('invoice_date_convert', date('d-M-y', strtotime($jsonString->invoice_date)));
        $templateProcessor->setValue('deadline_convert', date('d-M-y', strtotime($jsonString->deadline)));

        if ($jsonString->is_dolar == 1) {
            $templateProcessor->setValue('to_be_paid', '$' . $jsonString->result_wht);
            $templateProcessor->setValue('bank_charge_convert', '$' . $jsonString->bank_charge);
            $templateProcessor->setValue('total_convert', '$' . $jsonString->total);
        } else {
            $templateProcessor->setValue('to_be_paid', 'Rp' . $jsonString->result_wht);
            $templateProcessor->setValue('bank_charge_convert', 'Rp' . $jsonString->bank_charge);
            $templateProcessor->setValue('total_convert', 'Rp' . $jsonString->total);
        }



        if ($jsonString->total_wht != 0) {
            if ($jsonString->is_dolar == 1) {
                $templateProcessor->setValues(
                    ['vat_title' => "VAT %", 'vat_body' => '$' . $jsonString->result_vat],
                );


                $templateProcessor->setValues(
                    ['wht_title' => "WHT", 'wht_body' => '(' . '$' . $jsonString->total_wht . ')']
                );
            } else {
                $templateProcessor->setValues(
                    ['vat_title' => "VAT %", 'vat_body' => 'Rp' . $jsonString->result_vat],
                );


                $templateProcessor->setValues(
                    ['wht_title' => "WHT", 'wht_body' => '(' . 'Rp' . $jsonString->total_wht . ')']
                );
            }
        } else {
            $templateProcessor->setValues(
                ['vat_title' => "", 'vat_body' => ''],
            );


            $templateProcessor->setValues(
                ['wht_title' => "", 'wht_body' => '']
            );
        }




        $templateProcessor->cloneRowAndSetValues('description', $description);


        $saveDocPath = public_path('FinanceFormMenu.docx');

        $templateProcessor->saveAs($saveDocPath);

        return response()->download($saveDocPath);



        $FileHandle = fopen('FinanceForm.pdf', 'w+');

        $curl = curl_init();

        $instructions = '{
            "parts": [
                {
                "file": "document"
                }
            ]
        }';

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.pspdfkit.com/build',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_POSTFIELDS => array(
                'instructions' => $instructions,
                'document' => new CURLFile('FinanceFormMenu.docx')
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer pdf_live_PMWNGJl4qTCXi0pfS9Qa5Q3RqEpqLwX7bMtjEq9SzYE'
            ),
            CURLOPT_FILE => $FileHandle,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        fclose($FileHandle);


        $filepath = public_path('FinanceForm.pdf');
        // return Response::download($filepath);
    }
}
