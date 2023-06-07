<?php

namespace App\Http\Controllers;

use App\Models\DebitNoteModel;
use App\Models\DescriptionDebitModel;
use App\Models\DivisionModel;
use DateTime;
use CURLFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;


class DebitNoteController extends Controller
{
    private $title = 'Debit Note';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DebitNoteModel::get();
        $desc = DescriptionDebitModel::get();
        return view('debit_note.index', compact('data','desc'))->with(['title' => $this->title]);
    }

    public function create()
    {
        $division = DivisionModel::all();
        return view('debit_note.add', compact('division'))->with(['title' => $this->title]);
    }

    public function store(Request $request)
    {

        // if ($request->wht > 100 || $request->wht < 1) {
        //     $validator = Validator::make($request->all(), [
        //         'wht' => 'numeric|min:1|max:100',
        //     ]);

        //     if ($validator->fails()) {
        //         return redirect()->back()
        //             ->withErrors($validator)
        //             ->withInput();
        //     }
        // }

        $isWhtNull = ($request->wht == '') ? 1 : 0;

        $division = DivisionModel::findOrFail($request->id_division);

        $dateTime = new DateTime($request->debit_note_date);

        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $month = $carbonDate->month;


        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $year = $carbonDate->year;

        $count =
            DebitNoteModel::where('id_division', $division->id)
            ->whereYear('debit_note_date', $year)
            ->whereMonth('debit_note_date', $month)
            ->count() + 1;

        $debitNote = DebitNoteModel::create([
            'no_invoice' => $request->no_invoice,
            'invoice_date' => $request->invoice_date,
            "tax_invoice_serial_no" => $request->tax_invoice_serial_no,
            'tax_invoice_date' => $request->tax_invoice_date,
            "no_debit_note" => $count . '/' . $division->slug . date('/m/Y', strtotime($request->debit_note_date)),
            "id_division" => $request->id_division,
            "for" => $request->for,
            "received_bank" => $request->received_bank,
            "received_from" => $request->received_from,
            "debit_note_date" => $request->debit_note_date,
            "bank_charge" => $request->bank_charge,
            "is_dolar" => $request->is_dolar,
        ]);

        $total_description = 0;

        for ($i = 0; $i < count($request->description); $i++) {

            $total_description = $total_description + $request->price[$i];

            DescriptionDebitModel::create([
                "value" => $request->description[$i],
                "price" => $request->price[$i],
                "id_debit_note" => $debitNote->id,
            ]);
        }

        $vat = ($total_description * 11) / 100;

        $check_wht = ($isWhtNull == 0) ? $request->wht : 0;

        $wht =  ($total_description * $check_wht) / 100;

        $result = $total_description + $vat - $wht;

        DebitNoteModel::where('id', $debitNote->id)->update([
            'result_vat' => $vat,
            "total_wht" =>  $wht,
            "result_wht" => $result,
            "total" => $request->bank_charge + $result
        ]);

        return redirect()->route('debit_note');
    }

    public function delete($id)
    {
        DebitNoteModel::where('id', $id)->delete();
        $descData  = DescriptionDebitModel::where('id_debit_note', $id)->get();


        foreach ($descData as $key => $value) {

            DescriptionDebitModel::where('id', $value->id)->delete();
        }

        return redirect()->back();
    }


    public function edit($id)
    {
        $division = DivisionModel::all();
        $data = DebitNoteModel::find($id);
        $desc = DescriptionDebitModel::where('id_debit_note', $data->id)->get();
        return view('debit_note.edit', compact('division', 'data', 'desc'))->with(['title' => $this->title]);
    }

    public function update(Request $request)
    {

        $dateTime = new DateTime($request->tax_invoice_date);

        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $month = $carbonDate->month;


        $carbonDate = \Carbon\Carbon::instance($dateTime);
        $year = $carbonDate->year;

        $count =
            DebitNoteModel::whereYear('tax_invoice_date', $year)
            ->whereMonth('tax_invoice_date', $month)
            ->get()->count() + 1;

        $data = DebitNoteModel::findOrFail($request->id);

        $division = DivisionModel::findOrFail($request->id_division);


        $data->update([
            'no_invoice' => $request->no_invoice,
            'invoice_date' => $request->invoice_date,
            "tax_invoice_serial_no" => $request->tax_invoice_serial_no,
            'tax_invoice_date' => $request->tax_invoice_date,
            "no_debit_note" => $count . '/' . $division->slug . date('/m/Y', strtotime($request->date_pr)),
            "id_division" => $request->id_division,
            "for" => $request->for,
            "received_bank" => $request->received_bank,
        ]);

        $descData  = DescriptionDebitModel::where('id_debit_note', $request->id)->get();


        foreach ($descData as $key => $value) {

            DescriptionDebitModel::where('id', $value->id)->delete();
        }

        $total_description = 0;

        for ($i = 0; $i < count($request->description); $i++) {

            $total_description = $total_description + $request->price[$i];

            DescriptionDebitModel::create([
                "value" => $request->description[$i],
                "price" => $request->price[$i],
                "id_debit_note" => $request->id,
            ]);
        }

        $vat = ($total_description * 11) / 100;

        $wht =  ($total_description * $request->wht) / 100;

        $result = $total_description + $vat - $wht;


        DebitNoteModel::where('id', $request->id)->update([
            'result_vat' => $vat,
            "total_wht" =>  $wht,
            "result_wht" => $result,
        ]);

        return redirect()->route('debit_note');
    }

    public function print($id)
    {
        $jsonString  = DebitNoteModel::find($id);
        $data = json_decode($jsonString, true);


        $descData  = DescriptionDebitModel::where('id_debit_note', $id)->get();

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
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templateDebitNote.docx');
        } else {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templateDebitNoteMore4.docx');
            echo false;
        }

        $templateProcessor->setValues(
            $data,
        );

        $templateProcessor->setValues(
            $divData,
        );

        $templateProcessor->setValue(
            'debit_note_date_convert',
            date('d-M-Y', strtotime($jsonString->debit_note_date))
        );
        $templateProcessor->setValue('tax_invoice_date_convert', date('d-M-Y', strtotime($jsonString->tax_invoice_date)));
        $templateProcessor->setValue('invoice_date_convert', date('d-M-Y', strtotime($jsonString->invoice_date)));

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

        // header("Content-Disposition: attachment; filename=debit-note.docx");

        // $templateProcessor->saveAs('php://output');
        $saveDocPath = public_path('DebitNote.docx');

        $templateProcessor->saveAs($saveDocPath);

        $FileHandle = fopen('DebitNote.pdf', 'w+');

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
                'document' => new CURLFile('DebitNote.docx')
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer pdf_live_PMWNGJl4qTCXi0pfS9Qa5Q3RqEpqLwX7bMtjEq9SzYE'
            ),
            CURLOPT_FILE => $FileHandle,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        fclose($FileHandle);


        $filepath = public_path('DebitNote.pdf');
        // return Response::download($filepath);
    }
}
