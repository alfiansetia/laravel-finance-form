<?php

namespace App\Http\Controllers;

use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\PaymentRequestModel;
use App\Models\Vat;
use App\Models\Wht;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentRequestController extends Controller
{
    private $title = 'Payment Request';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role')->only(['destroy']);
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
        return view('payment_request.detail')->with([
            'title'     => $this->title,
            'data'      => $payment,
            'path_logo' => asset('logo.jpg'),
            'vat'       => Vat::first(),
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
        $this->validate($request, [
            'beneficiary_bank'  => 'required',
            'invoice_date'      => 'required|date_format:Y-m-d',
            'received_date'     => 'required|date_format:Y-m-d|after_or_equal:invoice_date',
            'name_beneficiary'  => 'required',
            'bank_account'      => 'required',
            'for'               => 'required',
            'currency'          => 'required|in:idr,usd,sgd',
            'vat'               => 'required|in:yes,no',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|integer|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required|integer|gt:0',
        ]);

        $invoice_date = Carbon::parse($request->invoice_date);

        $deadline = $invoice_date->addDays($request->due_date);

        $total_description = 0;
        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }

        $wht_value = 0;
        $vat_value = 0;

        $vat = Vat::first();

        if ($request->vat == 'yes') {
            $vat_value = ($total_description * $vat->value) / 100;
        }

        $wht = Wht::find($request->wht);
        if ($wht) {
            $wht_value =  ($total_description * $wht->value) / 100;
        }

        $result = $total_description + $vat_value - $wht_value;

        $payment->update([
            'beneficiary_bank'  => $request->beneficiary_bank,
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            'name_beneficiary'  => $request->name_beneficiary,
            'bank_account'      => $request->bank_account,
            'for'               => $request->for,
            'contract'          => $request->contract,
            'currency'          => $request->currency,
            'vat'               => $request->vat,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            'result_vat'        => $vat_value,
            'total_wht'         => $wht_value,
            'result_wht'        => $result,
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
            'id_division'       => 'required|integer|exists:division,id',
            'beneficiary_bank'  => 'required',
            'invoice_date'      => 'required|date_format:Y-m-d',
            'received_date'     => 'required|date_format:Y-m-d|after_or_equal:invoice_date',
            'date_pr'           => 'required|date_format:Y-m-d',
            'name_beneficiary'  => 'required',
            'bank_account'      => 'required',
            'for'               => 'required',
            'currency'          => 'required|in:idr,usd,sgd',
            'vat'               => 'required|in:yes,no',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|integer|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required|integer|gt:0',
        ]);

        $division = DivisionModel::findOrFail($request->id_division);

        $dateTime = new DateTime($request->date_pr);

        $carbonDate = Carbon::instance($dateTime);
        $month = $carbonDate->month;

        $carbonDate = Carbon::instance($dateTime);
        $year = $carbonDate->year;


        // old function

        // $count =
        //     PaymentRequestModel::where('id_division', $division->id)
        //     ->whereYear('date_pr', $year)
        //     ->whereMonth('date_pr', $month)
        //     ->count() + 1;

        // $counti = str_pad($count, 4, '0', STR_PAD_LEFT);
        // $counti . '/' . $division->slug . date('/m/y', strtotime($request->date_pr))


        $count =
            PaymentRequestModel::where('id_division', $division->id)
            ->whereYear('date_pr', $year)
            ->whereMonth('date_pr', $month)
            ->orderByDesc('no_pr')
            ->first();

        $counti = ($count->no_pr ?? 0) + 1;

        $total_description = 0;
        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }
        $wht_value = 0;
        $vat_value = 0;

        $vat = Vat::first();

        if ($request->vat == 'yes') {
            $vat_value = ($total_description * $vat->value) / 100;
        }

        $wht = Wht::find($request->wht);
        if ($wht) {
            $wht_value =  ($total_description * $wht->value) / 100;
        }

        $result = $total_description + $vat_value - $wht_value;

        $invoice_date = Carbon::parse($request->invoice_date);
        $deadline = $invoice_date->addDays($request->due_date);
        $payment = PaymentRequestModel::create([
            'no_pr'             => $counti,
            'id_division'       => $request->id_division,
            'beneficiary_bank'  => $request->beneficiary_bank,
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            // 'contract'      =>  $request->contract,
            'date_pr'           => $request->date_pr,
            'name_beneficiary'  => $request->name_beneficiary,
            'bank_account'      => $request->bank_account,
            'for'               => $request->for,
            'contract'          => $request->contract,
            'currency'          => $request->currency,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            'result_vat'        => $vat_value,
            'total_wht'         => $wht_value,
            'result_wht'        => $result,
            'deadline'          => $deadline,
            'total'             => $request->bank_charge + $result,
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
        $vat = Vat::first();
        $pdf = Pdf::loadview('payment_request.download', [
            'title'     => 'Detail ' . $payment->no_pr,
            'data'      => $payment,
            'path_logo' => public_path('logo.jpg'),
            'vat'       => $vat,
        ])->setPaper('A4', 'portrait');
        return $pdf->download($payment->id . '_' . date('ymdHis') . '.pdf');
    }
}
