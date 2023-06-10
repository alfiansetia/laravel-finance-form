<?php

namespace App\Http\Controllers;

use App\Models\DebitNoteModel;
use App\Models\PaymentRequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{

    private $title = 'Dashboard';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        $data['payment_month'] = PaymentRequestModel::whereYear('date_pr', $year)
            ->whereMonth('date_pr', $month)
            ->count();
        $data['debit_month'] = DebitNoteModel::whereYear('debit_note_date', $year)
            ->whereMonth('debit_note_date', $month)
            ->count();
        $data['payment_all'] = PaymentRequestModel::count();
        $data['debit_all'] = DebitNoteModel::count();

        $data['payment'] = [];
        $data['debit'] = [];
        $data['label'] = [];


        for ($i = 1; $i <= 12; $i++) {
            $startDate = Carbon::createFromDate($year, $i, 1);

            $total_payment = PaymentRequestModel::whereYear('date_pr', $year)
                ->whereMonth('date_pr', $i)
                ->count();
            $total_debit = DebitNoteModel::whereYear('debit_note_date', $year)
                ->whereMonth('debit_note_date', $i)
                ->count();

            $data['label'][] = Carbon::parse($startDate)->format('M');
            $data['payment']['value'][] = $total_payment;
            $data['debit']['value'][] = $total_debit;
        }

        return view('home', compact('data'))->with(['title' => $this->title]);
    }
}
