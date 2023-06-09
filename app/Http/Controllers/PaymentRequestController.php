<?php

namespace App\Http\Controllers;

use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\PaymentRequestModel;
use App\Models\Wht;
use Barryvdh\DomPDF\Facade\Pdf;
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


class PaymentRequestController extends Controller
{
    private $title = 'Payment Request';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = PaymentRequestModel::all();
        return view('payment_request.index', compact('data'))->with(['title' => $this->title]);
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
        return view('payment_request.detail', compact('payment'))->with([
            'title' => 'Detail ' . $payment->no_pr,
            'path_logo' => asset('logo.jpg'),
        ]);
    }

    public function edit(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $wht = Wht::get();
        $division = DivisionModel::get();
        $data = $payment;
        return view('payment_request.edit', compact('division', 'data', 'wht'))->with(['title' => $this->title]);
    }

    public function update(Request $request, PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }

        $invoice_date = \Carbon\Carbon::parse($request->invoice_date);

        $deadline = $invoice_date->addDays($request->due_date);

        $total_description = 0;
        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }

        $wht_value = 0;
        $vat_value = 0;

        if ($request->vat == 'yes') {
            $vat_value = ($total_description * 11) / 100;
        }

        $wht = Wht::find($request->wht);
        if ($wht) {
            $wht_value =  ($total_description * $wht->value) / 100;
        }

        $result = $total_description + $vat_value - $wht_value;

        $payment->update([
            'contract'          => $request->contract,
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            'name_beneficiary'  => $request->name_beneficiary,
            'bank_account'      => $request->bank_account,
            'beneficiary_bank'  => $request->beneficiary_bank,
            'for'               => $request->for,
            'due_date'          => $request->due_date,
            "is_dolar"          => 0,
            "currency"          => $request->currency,
            'result_vat'        => $vat_value,
            "total_wht"         => $wht_value,
            "result_wht"        => $result,
            'deadline'          => $deadline,
            'total'             => ($request->bank_charge ?? 0) + $result,
        ]);

        $descData  = $payment->desc;

        foreach ($descData as $key => $value) {
            DescriptionModel::find($value->id)->delete();
        }

        $total_description = 0;

        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionModel::create([
                "value"                 => $request->description[$i],
                "price"                 => $request->price[$i],
                "id_payment_request"    => $payment->id,
            ]);
        }

        if ($payment) {
            return redirect()->route('payment.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('payment.index')->with(['error' => 'Data gagal diubah!']);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_division'       => 'required|exists:division,id',
            'beneficiary_bank'  => 'required',
            'invoice_date'      => 'required|date_format:Y-m-d',
            'received_date'     => 'required|date_format:Y-m-d',
            'date_pr'           => 'required|date_format:Y-m-d',
            'name_beneficiary'  => 'required',
            'bank_account'      => 'required',
            'for'               => 'required',
            'currency'          => 'required|in:idr,usd,sgd',
            'vat'               => 'required|in:yes,no',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|gte:0',
            'bank_charge'       => 'required|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
        ]);

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

        $total_description = 0;
        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }
        $wht_value = 0;
        $vat_value = 0;

        if ($request->vat == 'yes') {
            $vat_value = ($total_description * 11) / 100;
        }

        $wht = Wht::find($request->wht);
        if ($wht) {
            $wht_value =  ($total_description * $wht->value) / 100;
        }

        $result = $total_description + $vat_value - $wht_value;

        $invoice_date = \Carbon\Carbon::parse($request->invoice_date);
        $deadline = $invoice_date->addDays($request->due_date);

        $payment = PaymentRequestModel::create([
            'no_pr'             => $counti . '/' . $division->slug . date('/m/y', strtotime($request->date_pr)),
            'id_division'       => $request->id_division,
            'beneficiary_bank'  => $request->beneficiary_bank,
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            // 'contract'      =>  $request->contract,
            'date_pr'           => $request->date_pr,
            'name_beneficiary'  => $request->name_beneficiary,
            'bank_account'      => $request->bank_account,
            'for'               => $request->for,
            'currency'          => $request->currency,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            'result_vat'        => $vat_value,
            'total_wht'         => $wht_value,
            'result_wht'        => $result,
            'deadline'          => $deadline,
            'total'             => ($request->bank_charge ?? 0) + $result,
        ]);

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionModel::create([
                'value'                 => $request->description[$i],
                'price'                 => $request->price[$i],
                'id_payment_request'    => $payment->id,
            ]);
        }
        if ($payment) {
            return redirect()->route('payment.index')->with(['success' => 'Data berhasil ditambah!']);
        } else {
            return redirect()->route('payment.index')->with(['error' => 'Data gagal ditambah!']);
        }
    }

    public function destroy(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $payment = $payment->delete();
        if ($payment) {
            return redirect()->route('payment.index')->with(['success' => 'Data Berhasil dihapus!']);
        } else {
            return redirect()->route('payment.index')->with(['error' => 'Data Gagal dihapus!']);
        }
    }

    public function download(PaymentRequestModel $payment)
    {
        $payment = $payment;
        if (!$payment) {
            abort(404);
        }
        $desc  = DescriptionModel::where('id_payment_request', $payment->id)->get();
        $divition  = DivisionModel::where('id', $payment->id_division)->first();
        $pdf = Pdf::loadview('payment_request.download', [
            'desc' => $desc,
            'divition' => $divition,
            'payment' => $payment,
            'title' => 'Detail ' . $payment->no_pr,
            'path_logo' => public_path('logo.jpg'),
        ])->setPaper('A4', 'portrait');
        // ->setOptions([
        //     'margin_top' => 10,
        //     'margin_bottom' => 10,
        //     'margin_left' => 10,
        //     'margin_right' => 10,
        // ]);
        return $pdf->download($payment->id . '_' . date('ymdHis') . '.pdf');
    }
}
