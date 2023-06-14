<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\DebitNoteModel;
use App\Models\DescriptionDebitModel;
use App\Models\DivisionModel;
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
        $desc = DescriptionDebitModel::all();
        return view('debit_note.index', compact('data', 'desc'))->with(['title' => $this->title]);
    }

    public function create()
    {
        $bank = Bank::all();
        $wht = Wht::all();
        $division = DivisionModel::all();
        return view('debit_note.add', compact('division', 'wht', 'bank'))->with(['title' => $this->title]);
    }

    public function show(DebitNoteModel $debit)
    {
        if (!$debit) {
            abort(404);
        }
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
            'for'                   => 'required|max:100',
            'currency'              => 'required|in:idr,usd,sgd',
            'vat'                   => 'required|in:yes,no',
            'wht'                   => 'nullable|integer|exists:whts,id',
            'bank_charge'           => 'required|integer|gte:0',
            'description'           => 'required|array|min:1',
            'price'                 => 'required|array|min:1',
            'description.*'         => 'required|max:120',
            'price.*'               => 'required|integer|gt:0',
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
            $counti = ($count->getOriginal('no_debit_note') ?? 0) + 1;
        }

        $vat_value = 0;

        if ($request->vat == 'yes') {
            $vat = Vat::first();
            $vat_value = $vat->value ?? 0;
        }

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
            'vat'                   => $vat_value,
            'bank_charge'           => $request->bank_charge,
            'received_from'         => $request->received_from,
        ]);

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionDebitModel::create([
                'value'         => $request->description[$i],
                'price'         => $request->price[$i],
                'id_debit_note' => $debitNote->id,
            ]);
        }
        if ($debitNote) {
            return redirect()->route('debit.index')->with(['success' => 'Data berhasil ditambah!']);
        } else {
            return redirect()->route('debit.index')->with(['error' => 'Data gagal ditambah!']);
        }
    }

    public function destroy(DebitNoteModel $debit)
    {
        if (!$debit) {
            abort(404);
        }
        $debit = $debit->delete();
        if ($debit) {
            return redirect()->route('debit.index')->with(['success' => 'Data Berhasil dihapus!']);
        } else {
            return redirect()->route('debit.index')->with(['error' => 'Data Gagal dihapus!']);
        }
    }

    public function edit(DebitNoteModel $debit)
    {
        if (!$debit) {
            abort(404);
        }
        $bank = Bank::where('division_id', $debit->id_division)->get();
        $data = $debit;
        $wht = Wht::all();
        return view('debit_note.edit', compact('data', 'wht', 'bank'))->with(['title' => $this->title]);
    }

    public function update(Request $request, DebitNoteModel $debit)
    {
        if (!$debit) {
            abort(404);
        }
        $this->validate($request, [
            'received_bank'         => 'required|integer|exists:banks,id,division_id,' . $debit->id_division,
            'no_invoice'            => 'required|integer|gte:0',
            'invoice_date'          => 'required|date_format:Y-m-d',
            'tax_invoice_serial_no' => 'required',
            'tax_invoice_date'      => 'required|date_format:Y-m-d',
            'for'                   => 'required',
            'currency'              => 'required|in:idr,usd,sgd',
            'vat'                   => 'required|gte:0',
            'wht'                   => 'nullable|integer|exists:whts,id',
            'bank_charge'           => 'required|integer|gte:0',
            'description'           => 'required|array|min:1',
            'price'                 => 'required|array|min:1',
            'description.*'         => 'required|max:120',
            'price.*'               => 'required|integer|gt:0',
        ]);

        foreach ($debit->desc as $item) {
            DescriptionDebitModel::where('id', $item->id)->delete();
        }

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionDebitModel::create([
                'id_debit_note' => $debit->id,
                'value'         => $request->description[$i],
                'price'         => $request->price[$i],
            ]);
        }

        $debit = $debit->update([
            'no_invoice'            => $request->no_invoice,
            'bank_id'               => $request->received_bank,
            'no_invoice'            => $request->no_invoice,
            'invoice_date'          => $request->invoice_date,
            'tax_invoice_serial_no' => $request->tax_invoice_serial_no,
            'tax_invoice_date'      => $request->tax_invoice_date,
            'for'                   => $request->for,
            'currency'              => $request->currency,
            'wht_id'                => $request->wht,
            'vat'                   => $request->vat,
            'bank_charge'           => $request->bank_charge,
        ]);

        if ($debit) {
            return redirect()->route('debit.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('debit.index')->with(['error' => 'Data gagal diubah!']);
        }
    }

    public function download(DebitNoteModel $debit)
    {
        $debit = $debit;
        if (!$debit) {
            abort(404);
        }
        $pdf = Pdf::loadview('debit_note.download', [
            'title'     => 'Detail ' . $debit->no_pr,
            'data'      => $debit,
            'path_logo' => public_path('logo.jpg'),
        ])->setPaper('A4', 'portrait');
        return $pdf->download($debit->id . '_' . date('ymdHis') . '.pdf');
    }
}
