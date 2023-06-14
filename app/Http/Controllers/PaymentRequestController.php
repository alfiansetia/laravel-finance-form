<?php

namespace App\Http\Controllers;

use App\Models\Bank;
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
        $this->middleware('role')->only(['destroy']);
    }

    public function index()
    {
        $data = PaymentRequestModel::all();
        return view('payment_request.index', compact('data'))->with(['title' => $this->title]);
    }

    public function create()
    {
        $bank = Bank::all();
        $wht = Wht::all();
        $division = DivisionModel::all();
        return view('payment_request.add', compact('division', 'wht', 'bank'))->with(['title' => $this->title]);
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
        ]);
    }

    public function edit(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $bank = Bank::where('division_id', $payment->id_division)->get();
        $wht = Wht::all();
        $data = $payment;
        return view('payment_request.edit', compact('data', 'wht', 'bank'))->with(['title' => $this->title]);
    }

    public function update(Request $request, PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $this->validate($request, [
            'beneficiary_bank'  => 'required|integer|exists:banks,id,division_id,' . $payment->id_division,
            'invoice_date'      => 'required|date_format:Y-m-d',
            'received_date'     => 'required|date_format:Y-m-d|after_or_equal:invoice_date',
            'name_beneficiary'  => 'required|max:100',
            'bank_account'      => 'required|max:100',
            'for'               => 'required|max:100',
            'currency'          => 'required|in:idr,usd,sgd',
            'vat'               => 'required|integer|gte:0',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|integer|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required|integer|gt:0',
        ]);

        $descData  = $payment->desc;

        foreach ($descData as $item) {
            DescriptionModel::find($item->id)->delete();
        }

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionModel::create([
                'id_payment_request'    => $payment->id,
                'value'                 => $request->description[$i],
                'price'                 => $request->price[$i],
            ]);
        }

        $payment = $payment->update([
            'bank_id'           => $request->beneficiary_bank,
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
        ]);


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
            'beneficiary_bank'  => 'required|integer|exists:banks,id,division_id,' . $request->id_division,
            'invoice_date'      => 'required|date_format:Y-m-d',
            'received_date'     => 'required|date_format:Y-m-d|after_or_equal:invoice_date',
            'date_pr'           => 'required|date_format:Y-m-d',
            'name_beneficiary'  => 'required|max:100',
            'bank_account'      => 'required|max:100',
            'for'               => 'required|max:100',
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
            PaymentRequestModel::where('id_division', $request->id_division)
            ->whereYear('date_pr', $year)
            ->whereMonth('date_pr', $month)
            ->orderByDesc('no_pr')
            ->first();

        $counti = 1;
        if ($count) {
            $counti = ($count->getOriginal('no_pr') ?? 0) + 1;
        }

        $vat_value = 0;
        if ($request->vat == 'yes') {
            $vat = Vat::first();
            $vat_value = $vat->value ?? 0;
        }

        $payment = PaymentRequestModel::create([
            'no_pr'             => $counti,
            'id_division'       => $request->id_division,
            'bank_id'           => $request->beneficiary_bank,
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            'date_pr'           => $request->date_pr,
            'name_beneficiary'  => $request->name_beneficiary,
            'bank_account'      => $request->bank_account,
            'for'               => $request->for,
            'contract'          => $request->contract,
            'currency'          => $request->currency,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            'vat'               => $vat_value,
        ]);

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionModel::create([
                'id_payment_request'    => $payment->id,
                'value'                 => $request->description[$i],
                'price'                 => $request->price[$i],
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
        $pdf = Pdf::loadview('payment_request.download', [
            'title'     => 'Detail ' . $payment->no_pr,
            'data'      => $payment,
            'path_logo' => public_path('logo.jpg'),
        ])->setPaper('A4', 'portrait');
        return $pdf->download($payment->id . '_' . date('ymdHis') . '.pdf');
    }
}
