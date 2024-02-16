<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\DescriptionModel;
use App\Models\DivisionModel;
use App\Models\PaymentRequestModel;
use App\Models\Status;
use App\Models\Validator;
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
        $vat = Vat::all();
        $vendor = Vendor::all();
        $division = DivisionModel::all();
        $status = Status::all();
        $validators = Validator::all();
        return view('payment_request.add', compact('division', 'wht', 'bank', 'vendor', 'status', 'validators', 'vat'))->with(['title' => $this->title]);
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
            // 'paid'      => asset('paid.png'),
            'status'    => Status::all(),
        ]);
    }

    public function edit(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        if ($payment->status_id == 4) {
            abort(403, 'Unauthorize!');
        }
        $bank = Bank::where('division_id', $payment->id_division)->get();
        $wht = Wht::all();
        $vat = Vat::all();
        $vendor = Vendor::all();
        $data = $payment->load('desc');
        $validators = Validator::all();
        return view('payment_request.edit', compact(['data', 'wht', 'bank', 'vendor', 'validators', 'vat']))->with(['title' => $this->title]);
    }

    public function update(Request $request, PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        if ($payment->status_id == 4) {
            abort(403, 'Unauthorize!');
        }
        $this->validate($request, [
            'beneficiary_bank'  => 'required|integer|exists:banks,id,division_id,' . $payment->id_division,
            'invoice_date'      => 'required|date_format:Y-m-d',
            'received_date'     => 'required|date_format:Y-m-d|after_or_equal:invoice_date',
            'beneficiary'       => 'required|integer|exists:vendors,id',
            'for'               => 'required|max:120',
            'currency'          => 'required|in:idrtoidr,idrtosgd,idrtousd,usdtousd',
            // 'vat'               => 'required|integer|gte:0',
            'vat'               => 'nullable|integer|exists:vats,id',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required',
            'description_add'   => 'nullable|array|min:1',
            'price_add'         => 'nullable|array|min:1',
            'description_add.*' => 'required|max:120',
            'price_add.*'       => 'required',
            'validator'         => 'required|integer|exists:validators,id',

            'vat_add'           => 'nullable|array|min:1',
            'wht_add'           => 'nullable|array|min:1',
            'vat_add.*'         => 'nullable|exists:vats,id',
            'wht_add.*'         => 'nullable|exists:whts,id',

            'pr_serial'         => 'nullable|array|min:1',
            'tax_date'          => 'nullable|array|min:1',
            'pr_serial.*'       => 'required|max:200',
            'tax_date.*'        => 'required|date_format:Y-m-d',

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
                'vat_id'                => $request->vat_add[$i],
                'wht_id'                => $request->wht_add[$i],
                'pr_serial'             => $request->pr_serial[$i],
                'tax_date'              => $request->tax_date[$i],
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
            // 'vat'               => $request->vat,
            'vat_id'            => $request->vat,
            'wht_id'            => $request->wht,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            'status_id'         => $payment->status_id == 3 ? 1 : $payment->status_id,
            'validator_id'      => $request->validator,
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
            'for'               => 'required|max:120',
            'currency'          => 'required|in:idrtoidr,idrtosgd,idrtousd,usdtousd',
            // 'vat'               => 'required|in:yes,no',
            'vat'               => 'nullable|integer|exists:vats,id',
            'wht'               => 'nullable|integer|exists:whts,id',
            'due_date'          => 'required|integer|gte:0',
            'bank_charge'       => 'required|gte:0',
            'description'       => 'required|array|min:1',
            'price'             => 'required|array|min:1',
            'description.*'     => 'required|max:120',
            'price.*'           => 'required',
            'description_add'   => 'nullable|array|min:1',
            'price_add'         => 'nullable|array|min:1',
            'description_add.*' => 'required|max:120',
            'price_add.*'       => 'required',
            'validator'         => 'required|integer|exists:validators,id',

            'vat_add'           => 'nullable|array|min:1',
            'wht_add'           => 'nullable|array|min:1',
            'vat_add.*'         => 'nullable|exists:vats,id',
            'wht_add.*'         => 'nullable|exists:whts,id',

            'pr_serial'         => 'nullable|array|min:1',
            'tax_date'          => 'nullable|array|min:1',
            'pr_serial.*'       => 'required|max:200',
            'tax_date.*'        => 'required|date_format:Y-m-d',

        ]);

        // dd($request->all());

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

        // $vat_value = 0;
        // if ($request->vat == 'yes') {
        //     $vat = Vat::first();
        //     $vat_value = $vat->value ?? 0;
        // }

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
            'vat_id'            => $request->vat,
            'due_date'          => $request->due_date,
            'bank_charge'       => $request->bank_charge,
            // 'vat'               => $vat_value,
            'status_id'         => 1,
            'validator_id'      => $request->validator,
        ]);

        for ($i = 0; $i < count($request->description ?? []); $i++) {
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
                'vat_id'                => $request->vat_add[$i],
                'wht_id'                => $request->wht_add[$i],
                'pr_serial'             => $request->pr_serial[$i],
                'tax_date'              => $request->tax_date[$i],
            ]);
        }

        if ($payment) {
            return redirect()->route('payment.index')->with(['success' =>  __('lang.success_store')]);
        } else {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.failed_store')]);
        }
    }

    public function destroy(PaymentRequestModel $payment)
    {
        if (!$payment) {
            abort(404);
        }
        if ($payment->status_id == 4 && auth()->user()->role != 'admin') {
            abort(403, 'Unauthorize!');
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
        if ($payment->status_id == 3) {
            return redirect()->route('payment.index')->with(['error' => $this->title . ' ' .  __('lang.belum_approve')]);
        }
        if (!$payment) {
            abort(404);
        }
        $pdf = Pdf::loadview('payment_request.download', [
            'title'     => 'Detail ' . $payment->no_pr,
            'data'      => $payment,
            'path_logo' => public_path('logo.jpg'),
            // 'paid'      => public_path('paid.png'),
        ])->setPaper('A4', 'portrait');
        return $pdf->download($payment->id . '_' . date('ymdHis') . '.pdf');
    }

    public function status(Request $request, PaymentRequestModel $payment)
    {
        $this->validate($request, [
            'status'   => 'required|integer|exists:statuses,id',
            'note'     => 'nullable|max:150',
        ]);

        // if (count($payment->filepr ?? []) < 1) {
        //     return redirect()->back()->with(['error' => __('lang.file_notfound')]);
        // }

        if ($payment->status_id == 4) {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.status_unavailable')]);
        }

        // if ($request->status == 2 || $request->status == 3) {
        //     return redirect()->route('payment.index')->with(['error' => __('lang.no_action')]);
        // }

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

    public function paid(Request $request, PaymentRequestModel $payment)
    {
        // if (count($payment->filepr ?? []) < 1) {
        //     return redirect()->back()->with(['error' => __('lang.file_notfound')]);
        // }

        if ($payment->status_id != 2) {
            return redirect()->route('payment.index')->with(['error' =>  __('lang.status_unavailable')]);
        }

        if ($request->status == 2 || $request->status == 3) {
            return redirect()->route('payment.index')->with(['error' => __('lang.no_action')]);
        }

        $payment = $payment->update([
            'status_id' => 4,
            'paid_date' => $request->date,
        ]);

        if ($payment) {
            return redirect()->route('payment.index')->with(['success' => __('lang.success_status')]);
        } else {
            return redirect()->route('payment.index')->with(['error' => __('lang.failed_status')]);
        }
    }
}
