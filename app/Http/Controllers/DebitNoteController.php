<?php

namespace App\Http\Controllers;

use App\Models\DebitNoteModel;
use App\Models\DescriptionDebitModel;
use App\Models\DivisionModel;
use App\Models\Wht;
use DateTime;
use CURLFile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class DebitNoteController extends Controller
{
    private $title = 'Debit Note';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DebitNoteModel::all();
        $desc = DescriptionDebitModel::all();
        return view('debit_note.index', compact('data', 'desc'))->with(['title' => $this->title]);
    }

    public function create()
    {
        $wht = Wht::all();
        $division = DivisionModel::all();
        return view('debit_note.add', compact('division', 'wht'))->with(['title' => $this->title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_division'           => 'required|integer|exists:division,id',
            'received_bank'         => 'required',
            'no_invoice'            => 'required|integer|gte:0',
            'invoice_date'          => 'required|date_format:Y-m-d',
            'debit_note_date'       => 'required|date_format:Y-m-d',
            'tax_invoice_serial_no' => 'required',
            'tax_invoice_date'      => 'required|date_format:Y-m-d',
            'for'                   => 'required',
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
            ->count() + 1;
        $counti = str_pad($count, 4, '0', STR_PAD_LEFT);

        $total_description = 0;
        $wht_value = 0;
        $vat_value = 0;

        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }

        if ($request->vat == 'yes') {
            $vat_value = ($total_description * 11) / 100;
        }

        $wht = Wht::find($request->wht);
        if ($wht) {
            $wht_value =  ($total_description * $wht->value) / 100;
        }

        $result = $total_description + $vat_value - $wht_value;

        $debitNote = DebitNoteModel::create([
            'no_debit_note'         => $counti . '/' . $division->slug . date('/m/y', strtotime($request->debit_note_date)),
            'id_division'           => $request->id_division,
            'received_bank'         => $request->received_bank,
            'no_invoice'            => $request->no_invoice,
            'invoice_date'          => $request->invoice_date,
            'debit_note_date'       => $request->debit_note_date,
            'tax_invoice_serial_no' => $request->tax_invoice_serial_no,
            'tax_invoice_date'      => $request->tax_invoice_date,
            'for'                   => $request->for,
            'currency'              => $request->currency,
            'wht_id'                => $request->wht,
            'bank_charge'           => $request->bank_charge,
            'received_from'         => $request->received_from,
            'result_vat'            => $vat_value,
            'total_wht'             => $wht_value,
            'result_wht'            => $result,
            'total'                 => $request->bank_charge + $result
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
        $data = $debit;
        $wht = Wht::all();
        $division = DivisionModel::get();
        return view('debit_note.edit', compact('division', 'data', 'wht'))->with(['title' => $this->title]);
    }

    public function update(Request $request, DebitNoteModel $debit)
    {
        if (!$debit) {
            abort(404);
        }
        $this->validate($request, [
            'received_bank'         => 'required',
            'no_invoice'            => 'required|integer|gte:0',
            'invoice_date'          => 'required|date_format:Y-m-d',
            'tax_invoice_serial_no' => 'required',
            'tax_invoice_date'      => 'required|date_format:Y-m-d',
            'for'                   => 'required',
            'currency'              => 'required|in:idr,usd,sgd',
            'vat'                   => 'required|in:yes,no',
            'wht'                   => 'nullable|integer|exists:whts,id',
            'bank_charge'           => 'required|integer|gte:0',
            'description'           => 'required|array|min:1',
            'price'                 => 'required|array|min:1',
            'description.*'         => 'required|max:120',
            'price.*'               => 'required|integer|gt:0',
        ]);

        $total_description = 0;
        $wht_value = 0;
        $vat_value = 0;

        for ($i = 0; $i < count($request->description); $i++) {
            $total_description = $total_description + $request->price[$i];
        }
        if ($request->vat == 'yes') {
            $vat_value = ($total_description * 11) / 100;
        }

        $wht = Wht::find($request->wht);
        if ($wht) {
            $wht_value =  ($total_description * $wht->value) / 100;
        }

        $result = $total_description + $vat_value - $wht_value;

        $debit->update([
            'no_invoice'            => $request->no_invoice,
            'received_bank'         => $request->received_bank,
            'no_invoice'            => $request->no_invoice,
            'invoice_date'          => $request->invoice_date,
            'tax_invoice_serial_no' => $request->tax_invoice_serial_no,
            'tax_invoice_date'      => $request->tax_invoice_date,
            'for'                   => $request->for,
            'currency'              => $request->currency,
            'wht_id'                => $request->wht,
            'bank_charge'           => $request->bank_charge,
            'result_vat'            => $vat_value,
            'total_wht'             => $wht_value,
            'result_wht'            => $result,
        ]);

        foreach ($debit->desc as $value) {
            DescriptionDebitModel::where('id', $value->id)->delete();
        }

        for ($i = 0; $i < count($request->description); $i++) {
            DescriptionDebitModel::create([
                'value'         => $request->description[$i],
                'price'         => $request->price[$i],
                'id_debit_note' => $debit->id,
            ]);
        }

        if ($debit) {
            return redirect()->route('debit.index')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->route('debit.index')->with(['error' => 'Data gagal diubah!']);
        }
    }

    // public function print($id)
    // {
    //     $jsonString  = DebitNoteModel::find($id);
    //     $data = json_decode($jsonString, true);


    //     $descData  = DescriptionDebitModel::where('id_debit_note', $id)->get();

    //     $div  = DivisionModel::where('id', $jsonString->id_division)->first();
    //     $divData = json_decode($div, true);

    //     $description = [];

    //     foreach ($descData as $key => $value) {

    //         if ($jsonString->is_dolar == 1) {
    //             array_push($description, ['description' =>   $value->value, 'price' => '$' . $value->price]);
    //         } else {
    //             array_push(
    //                 $description,
    //                 ['description' =>   $value->value, 'price' => 'Rp' . $value->price]
    //             );
    //         }
    //     }

    //     if (count($description) < 4) {
    //         $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templateDebitNote.docx');
    //     } else {
    //         $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templateDebitNoteMore4.docx');
    //         echo false;
    //     }

    //     $templateProcessor->setValues(
    //         $data,
    //     );

    //     $templateProcessor->setValues(
    //         $divData,
    //     );

    //     $templateProcessor->setValue(
    //         'debit_note_date_convert',
    //         date('d-M-Y', strtotime($jsonString->debit_note_date))
    //     );
    //     $templateProcessor->setValue('tax_invoice_date_convert', date('d-M-Y', strtotime($jsonString->tax_invoice_date)));
    //     $templateProcessor->setValue('invoice_date_convert', date('d-M-Y', strtotime($jsonString->invoice_date)));

    //     if ($jsonString->is_dolar == 1) {
    //         $templateProcessor->setValue('to_be_paid', '$' . $jsonString->result_wht);
    //         $templateProcessor->setValue('bank_charge_convert', '$' . $jsonString->bank_charge);
    //         $templateProcessor->setValue('total_convert', '$' . $jsonString->total);
    //     } else {
    //         $templateProcessor->setValue('to_be_paid', 'Rp' . $jsonString->result_wht);
    //         $templateProcessor->setValue('bank_charge_convert', 'Rp' . $jsonString->bank_charge);
    //         $templateProcessor->setValue('total_convert', 'Rp' . $jsonString->total);
    //     }

    //     if ($jsonString->total_wht != 0) {
    //         if ($jsonString->is_dolar == 1) {
    //             $templateProcessor->setValues(
    //                 ['vat_title' => "VAT %", 'vat_body' => '$' . $jsonString->result_vat],
    //             );


    //             $templateProcessor->setValues(
    //                 ['wht_title' => "WHT", 'wht_body' => '(' . '$' . $jsonString->total_wht . ')']
    //             );
    //         } else {
    //             $templateProcessor->setValues(
    //                 ['vat_title' => "VAT %", 'vat_body' => 'Rp' . $jsonString->result_vat],
    //             );


    //             $templateProcessor->setValues(
    //                 ['wht_title' => "WHT", 'wht_body' => '(' . 'Rp' . $jsonString->total_wht . ')']
    //             );
    //         }
    //     } else {
    //         $templateProcessor->setValues(
    //             ['vat_title' => "", 'vat_body' => ''],
    //         );


    //         $templateProcessor->setValues(
    //             ['wht_title' => "", 'wht_body' => '']
    //         );
    //     }

    //     $templateProcessor->cloneRowAndSetValues('description', $description);

    //     // header("Content-Disposition: attachment; filename=debit-note.docx");

    //     // $templateProcessor->saveAs('php://output');
    //     $saveDocPath = public_path('DebitNote.docx');

    //     $templateProcessor->saveAs($saveDocPath);

    //     $FileHandle = fopen('DebitNote.pdf', 'w+');

    //     $curl = curl_init();

    //     $instructions = '{
    //         "parts": [
    //             {
    //             "file": "document"
    //             }
    //         ]
    //     }';

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.pspdfkit.com/build',
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_POSTFIELDS => array(
    //             'instructions' => $instructions,
    //             'document' => new CURLFile('DebitNote.docx')
    //         ),
    //         CURLOPT_HTTPHEADER => array(
    //             'Authorization: Bearer pdf_live_PMWNGJl4qTCXi0pfS9Qa5Q3RqEpqLwX7bMtjEq9SzYE'
    //         ),
    //         CURLOPT_FILE => $FileHandle,
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     fclose($FileHandle);


    //     $filepath = public_path('DebitNote.pdf');
    //     // return Response::download($filepath);
    // }
}
