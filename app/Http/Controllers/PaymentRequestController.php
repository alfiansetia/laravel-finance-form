<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\PaymentRequestModel;
use App\Models\Status;
use App\Models\Vat;
use App\Models\Vendor;
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
        $reject = PaymentRequestModel::where('status_id', 3)->count();
        $status = Status::all();
        return view('payment_request.index', compact(['data', 'reject', 'status']))->with(['title' => $this->title]);
    }

    public function create()
    {
        $bank = Bank::all();
        $wht = Wht::all();
        $vendor = Vendor::all();
        $division = DivisionModel::all();
        $status = Status::all();
        return view('payment_request.add', compact('division', 'wht', 'bank', 'vendor', 'status'))->with(['title' => $this->title]);
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
            'paid'      => asset('paid.png'),
            'status'    => Status::all(),
        ]);
    }

    public function edit(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        if (auth()->user()->role == 'supervisor') {
            abort(403, 'Unauthorize!');
        }
        $bank = Bank::where('division_id', $payment->id_division)->get();
        $wht = Wht::all();
        $vendor = Vendor::all();
        $data = $payment->load('desc');
        return view('payment_request.edit', compact(['data', 'wht', 'bank', 'vendor']))->with(['title' => $this->title]);
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
            'beneficiary'       => 'required|integer|exists:vendors,id',
            'for'               => 'required|max:100',
            'currency'          => 'required|in:idr,usd,sgd',
            'vat'               => 'required|integer|gte:0',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|integer|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required|integer',
            'description_add'   => 'nullable|array|min:1',
            'price_add'         => 'nullable|array|min:1',
            'description_add.*' => 'required|max:120',
            'price_add.*'       => 'required|integer',
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
                'type'                  => 'reg',
            ]);
        }
        for ($i = 0; $i < count($request->description_add ?? []); $i++) {
            DescriptionModel::create([
                'id_payment_request'    => $payment->id,
                'value'                 => $request->description_add[$i],
                'price'                 => $request->price_add[$i],
                'type'                  => 'add',
            ]);
        }

        $payment = $payment->update([
            'bank_id'           => $request->beneficiary_bank,
            'invoice_date'      => $request->invoice_date,
            'received_date'     => $request->received_date,
            'vendor_id'         => $request->beneficiary,
            'for'               => $request->for,
            'contract'          => $request->contract,
            'currency'          => $request->currency,
            'vat'               => $request->vat,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            // 'status_id'         => 1,
        ]);


        if ($payment) {
            return redirect()->route('payment.index')->with(['success' => __('lang.success_update')]);
        } else {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.failed_update')]);
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
            'beneficiary'       => 'required|integer|exists:vendors,id',
            'for'               => 'required|max:100',
            'currency'          => 'required|in:idr,usd,sgd',
            'vat'               => 'required|in:yes,no',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|integer|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required|integer',
            'description_add'   => 'nullable|array|min:1',
            'price_add'         => 'nullable|array|min:1',
            'description_add.*' => 'required|max:120',
            'price_add.*'       => 'required|integer',
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
            $counti = ($count->getRawOriginal('no_pr') ?? 0) + 1;
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
            'vendor_id'         => $request->beneficiary,
            'for'               => $request->for,
            'contract'          => $request->contract,
            'currency'          => $request->currency,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            'vat'               => $vat_value,
            'status_id'         => 1,
        ]);

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionModel::create([
                'id_payment_request'    => $payment->id,
                'value'                 => $request->description[$i],
                'price'                 => $request->price[$i],
                'type'                  => 'reg',
            ]);
        }
        for ($i = 0; $i < count($request->description_add ?? []); $i++) {
            DescriptionModel::create([
                'id_payment_request'    => $payment->id,
                'value'                 => $request->description_add[$i],
                'price'                 => $request->price_add[$i],
                'type'                  => 'add',
            ]);
        }

        if ($payment) {
            return redirect()->route('payment.index')->with(['success' =>  __('lang.success_insert')]);
        } else {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.failed_insert')]);
        }
    }

    public function destroy(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        $payment = $payment->delete();
        if ($payment) {
            return redirect()->route('payment.index')->with(['success' =>  __('lang.success_destroy')]);
        } else {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.failed_destroy')]);
        }
    }

    public function download(PaymentRequestModel $payment)
    {
        if ($payment->status_id != 4) {
            return redirect()->route('payment.index')->with(['error' => $this->title . ' ' .  __('lang.belum_approve')]);
        }
        $payment = $payment;
        if (!$payment) {
            abort(404);
        }
        $pdf = Pdf::loadview('payment_request.download', [
            'title'     => 'Detail ' . $payment->no_pr,
            'data'      => $payment,
            'path_logo' => public_path('logo.jpg'),
            'paid'      => public_path('paid.png'),
        ])->setPaper('A4', 'portrait');
        return $pdf->download($payment->id . '_' . date('ymdHis') . '.pdf');
    }

    public function status(Request $request, PaymentRequestModel $payment)
    {
        $this->validate($request, [
            'status'   => 'required|integer|exists:statuses,id',
            'note'     => 'nullable|max:150',
        ]);

        if (count($payment->filepr ?? []) < 1) {
            return redirect()->back()->with(['error' => __('lang.file_notfound')]);
        }

        if ($payment->status_id == 4) {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.status_unavailable')]);
        }

        if (auth()->user()->role != 'supervisor' && ($request->status == 2 || $request->status == 3)) {
            return redirect()->route('payment.index')->with(['error' => __('lang.no_action')]);
        }

        $payment = $payment->update([
            'status_id' => $request->status,
            'note'      => $request->note,
        ]);

        if ($payment) {
            return redirect()->route('payment.index')->with(['success' => __('lang.success_status')]);
        } else {
            return redirect()->route('payment.index')->with(['error' => __('lang.failed_status')]);
        }
    }
}
