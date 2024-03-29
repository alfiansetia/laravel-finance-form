<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\DebitNoteModel;
use App\Models\DescriptionDebitModel;
use App\Models\DivisionModel;
use App\Models\Validator;
use App\Models\Vat;
use App\Models\Wht;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class DebitNoteController extends Controller
{
    private $title = 'Debit Note';

    public function __construct()
    {
        $this->middleware('role')->only(['destroy']);
    }

    public function index()
    {
        $data = DebitNoteModel::all();
        $reject = DebitNoteModel::where('status_id', 3)->count();
        $desc = DescriptionDebitModel::all();
        return view('debit_note.index', compact('data', 'desc', 'reject'))->with(['title' => $this->title]);
    }

    public function create()
    {
        $bank = Bank::all();
        $wht = Wht::all();
        $vat = Vat::all();
        $division = DivisionModel::all();
        $validators = Validator::all();
        return view('debit_note.add', compact('division', 'wht', 'bank', 'vat', 'validators'))->with(['title' => $this->title]);
    }

    public function show(DebitNoteModel $debit)
    {
        return view('debit_note.detail')->with([
            'title'     => $this->title,
            'data'      => $debit,
            'path_logo' => asset('logo.jpg'),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_division'           => 'required|integer|exists:division,id',
            'received_bank'         => 'required|integer|exists:banks,id,division_id,' . $request->id_division,
            'no_invoice'            => 'required|integer|gte:0',
            'invoice_date'          => 'required|date_format:Y-m-d',
            'debit_note_date'       => 'required|date_format:Y-m-d',
            'tax_invoice_serial_no' => 'required',
            'tax_invoice_date'      => 'required|date_format:Y-m-d',
            'for'                   => 'required|max:120',
            'currency'              => 'required|in:idrtoidr,idrtosgd,idrtousd,usdtousd',
            // 'vat'                   => 'required|in:yes,no',
            'wht'                   => 'nullable|integer|exists:whts,id',
            'vat'                   => 'nullable|integer|exists:vats,id',
            'bank_charge'           => 'required|gte:0',
            'received_from'         => 'required|max:100',
            'description'           => 'required|array|min:1',
            'price'                 => 'required|array|min:1',
            'description.*'         => 'required|max:120',
            'price.*'               => 'required',
            'description_add'       => 'nullable|array|min:1',
            'price_add'             => 'nullable|array|min:1',
            'description_add.*'     => 'required|max:120',
            'price_add.*'           => 'required',
            'wht_no'                => 'required',
            'wht_date'              => 'required|date_format:Y-m-d',
            'validator'             => 'required|integer|exists:validators,id',

            'vat_add'           => 'nullable|array|min:1',
            'wht_add'           => 'nullable|array|min:1',
            'vat_add.*'         => 'nullable|exists:vats,id',
            'wht_add.*'         => 'nullable|exists:whts,id',

            'pr_serial'         => 'nullable|array|min:1',
            'tax_date'          => 'nullable|array|min:1',
            'pr_serial.*'       => 'required|max:200',
            'tax_date.*'        => 'required|date_format:Y-m-d',

        ]);

        $division = DivisionModel::findOrFail($request->id_division);

        $dateTime = new DateTime($request->debit_note_date);

        $carbonDate = Carbon::instance($dateTime);
        $month = $carbonDate->month;

        $carbonDate = Carbon::instance($dateTime);
        $year = $carbonDate->year;

        $count =
            DebitNoteModel::where('id_division', $division->id)
            ->whereYear('debit_note_date', $year)
            ->whereMonth('debit_note_date', $month)
            ->orderByDesc('no_debit_note')
            ->first();

        $counti = 1;
        if ($count) {
            $counti = ($count->getRawOriginal('no_debit_note') ?? 0) + 1;
        }

        // $vat_value = 0;

        // if ($request->vat == 'yes') {
        //     $vat = Vat::first();
        //     $vat_value = $vat->value ?? 0;
        // }

        $debitNote = DebitNoteModel::create([
            'no_debit_note'         => $counti,
            'id_division'           => $request->id_division,
            'bank_id'               => $request->received_bank,
            'no_invoice'            => $request->no_invoice,
            'invoice_date'          => $request->invoice_date,
            'debit_note_date'       => $request->debit_note_date,
            'tax_invoice_serial_no' => $request->tax_invoice_serial_no,
            'tax_invoice_date'      => $request->tax_invoice_date,
            'for'                   => $request->for,
            'currency'              => $request->currency,
            'wht_id'                => $request->wht,
            'vat_id'                => $request->vat,
            // 'vat'                   => $vat_value,
            'bank_charge'           => $request->bank_charge,
            'received_from'         => $request->received_from,
            'status_id'             => 1,
            'wht_no'                => $request->wht_no,
            'wht_date'              => $request->wht_date,
            'validator_id'          => $request->validator,
            'checked_id'            => $request->checked,
            'prepared_id'           => $request->prepared,
        ]);

        for ($i = 0; $i < count($request->description ?? []); $i++) {
            DescriptionDebitModel::create([
                'id_debit_note' => $debitNote->id,
                'value'         => $request->description[$i],
                'price'         => $request->price[$i],
                'type'          => 'reg'
            ]);
        }

        for ($i = 0; $i < count($request->description_add ?? []); $i++) {
            DescriptionDebitModel::create([
                'id_debit_note' => $debitNote->id,
                'value'         => $request->description_add[$i],
                'price'         => $request->price_add[$i],
                'type'          => 'add',
                'vat_id'        => $request->vat_add[$i],
                'wht_id'        => $request->wht_add[$i],
                'pr_serial'     => $request->pr_serial[$i],
                'tax_date'      => $request->tax_date[$i],
            ]);
        }
        if ($debitNote) {
            return redirect()->route('debit.index')->with(['success' => __('lang.success_store')]);
        } else {
            return redirect()->route('debit.index')->with(['error' => __('lang.failed_insert')]);
        }
    }

    public function destroy(DebitNoteModel $debit)
    {
        $debit = $debit->delete();
        if ($debit) {
            return redirect()->route('debit.index')->with(['success' => __('lang.success_destroy')]);
        } else {
            return redirect()->route('debit.index')->with(['error' => __('lang.failed_destroy')]);
        }
    }

    public function edit(DebitNoteModel $debit)
    {
        $bank = Bank::where('division_id', $debit->id_division)->get();
        $data = $debit;
        $wht = Wht::all();
        $vat = Vat::all();
        $validators = Validator::all();
        return view('debit_note.edit', compact('data', 'wht', 'bank', 'vat', 'validators'))->with(['title' => $this->title]);
    }

    public function update(Request $request, DebitNoteModel $debit)
    {
        if ($debit->status_id == 4) {
            $this->validate($request, [
                'no_invoice'            => 'required|integer|gte:0',
                'invoice_date'          => 'required|date_format:Y-m-d',
                'tax_invoice_serial_no' => 'required',
                'tax_invoice_date'      => 'required|date_format:Y-m-d',
                'wht_no'                => 'required',
                'wht_date'              => 'required|date_format:Y-m-d',
                'validator'             => 'required|integer|exists:validators,id',
            ]);
            $debit = $debit->update([
                'no_invoice'            => $request->no_invoice,
                'invoice_date'          => $request->invoice_date,
                'tax_invoice_serial_no' => $request->tax_invoice_serial_no,
                'tax_invoice_date'      => $request->tax_invoice_date,
                'wht_no'                => $request->wht_no,
                'wht_date'              => $request->wht_date,
                'validator_id'          => $request->validator,
            ]);

            if ($debit) {
                return redirect()->route('debit.index')->with(['success' => __('lang.success_update')]);
            } else {
                return redirect()->route('debit.index')->with(['error' => __('lang.failed_update')]);
            }
        }

        $this->validate($request, [
            'received_bank'         => 'required|integer|exists:banks,id,division_id,' . $debit->id_division,
            'no_invoice'            => 'required|integer|gte:0',
            'invoice_date'          => 'required|date_format:Y-m-d',
            'tax_invoice_serial_no' => 'required',
            'tax_invoice_date'      => 'required|date_format:Y-m-d',
            'for'                   => 'required|max:120',
            'currency'              => 'required|in:idrtoidr,idrtosgd,idrtousd,usdtousd',
            // 'vat'                   => 'required|gte:0',
            'wht'                   => 'nullable|integer|exists:whts,id',
            'vat'                   => 'nullable|integer|exists:vats,id',
            'bank_charge'           => 'required|gte:0',
            'received_from'         => 'required|max:100',
            'description'           => 'required|array|min:1',
            'price'                 => 'required|array|min:1',
            'description.*'         => 'required|max:120',
            'price.*'               => 'required',
            'description_add'       => 'nullable|array|min:1',
            'price_add'             => 'nullable|array|min:1',
            'description_add.*'     => 'required|max:120',
            'price_add.*'           => 'required',
            'wht_no'                => 'required',
            'wht_date'              => 'required|date_format:Y-m-d',
            'validator'             => 'required|integer|exists:validators,id',

            'vat_add'           => 'nullable|array|min:1',
            'wht_add'           => 'nullable|array|min:1',
            'vat_add.*'         => 'nullable|exists:vats,id',
            'wht_add.*'         => 'nullable|exists:whts,id',

            'pr_serial'         => 'nullable|array|min:1',
            'tax_date'          => 'nullable|array|min:1',
            'pr_serial.*'       => 'required|max:200',
            'tax_date.*'        => 'required|date_format:Y-m-d',

        ]);

        foreach ($debit->desc as $item) {
            DescriptionDebitModel::where('id', $item->id)->delete();
        }

        for ($i = 0; $i < count($request->description ?? []); $i++) {
            DescriptionDebitModel::create([
                'id_debit_note' => $debit->id,
                'value'         => $request->description[$i],
                'price'         => $request->price[$i],
                'type'          => 'reg'
            ]);
        }

        for ($i = 0; $i < count($request->description_add ?? []); $i++) {
            DescriptionDebitModel::create([
                'id_debit_note' => $debit->id,
                'value'         => $request->description_add[$i],
                'price'         => $request->price_add[$i],
                'type'          => 'add',
                'vat_id'        => $request->vat_add[$i],
                'wht_id'        => $request->wht_add[$i],
                'pr_serial'     => $request->pr_serial[$i],
                'tax_date'      => $request->tax_date[$i],
            ]);
        }

        $debit = $debit->update([
            'no_invoice'            => $request->no_invoice,
            'bank_id'               => $request->received_bank,
            'invoice_date'          => $request->invoice_date,
            'tax_invoice_serial_no' => $request->tax_invoice_serial_no,
            'tax_invoice_date'      => $request->tax_invoice_date,
            'for'                   => $request->for,
            'currency'              => $request->currency,
            'wht_id'                => $request->wht,
            'vat_id'                => $request->vat,
            'bank_charge'           => $request->bank_charge,
            'received_from'         => $request->received_from,
            'wht_no'                => $request->wht_no,
            'wht_date'              => $request->wht_date,
            'status_id'             => $debit->status_id == 3 ? 1 : $debit->status_id,
            'validator_id'          => $request->validator,
        ]);

        if ($debit) {
            return redirect()->route('debit.index')->with(['success' => __('lang.success_update')]);
        } else {
            return redirect()->route('debit.index')->with(['error' => __('lang.failed_update')]);
        }
    }

    public function download(DebitNoteModel $debit)
    {
        if ($debit->status_id != 4) {
            return redirect()->route('debit.index')->with(['error' => $this->title . ' ' .  __('lang.belum_approve')]);
        }
        $pdf = Pdf::loadview('debit_note.download', [
            'title'     => 'Detail ' . $debit->no_pr,
            'data'      => $debit,
            'path_logo' => public_path('logo.jpg'),
        ])->setPaper('A4', 'portrait');
        return $pdf->download($debit->id . '_' . date('ymdHis') . '.pdf');
    }

    public function status(Request $request, DebitNoteModel $debit)
    {
        $this->validate($request, [
            'status'   => 'required|integer|exists:statuses,id',
            'note'     => 'nullable|max:150',
            // 'date'     => 'required|date_format:Y-m-d'
        ]);

        // if (count($debit->filedn ?? []) < 1) {
        //     return redirect()->back()->with(['error' => __('lang.file_notfound')]);
        // }

        if ($debit->status_id == 4) {
            return redirect()->route('debit.index')->with(['error' =>  __('lang.status_unavailable')]);
        }

        if ($request->status == 2 || $request->status == 3) {
            return redirect()->route('debit.index')->with(['error' => __('lang.no_action')]);
        }

        $debit = $debit->update([
            'status_id' => $request->status,
            'note'      => $request->note,
            'paid_date' => $debit->invoice_date
        ]);

        if ($debit) {
            return redirect()->route('debit.index')->with(['success' => __('lang.success_status')]);
        } else {
            return redirect()->route('debit.index')->with(['error' => __('lang.failed_status')]);
        }
    }
}
