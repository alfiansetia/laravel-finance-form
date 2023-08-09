<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    private $title_payment = 'Report Payment Request';

    public function __construct()
    {
        $this->middleware('role');
    }

    function payment(Request $request)
    {
        $data = [];

        $from = Carbon::parse(date('Y-m-d'))->startOfMonth();
        $to = Carbon::parse(date('Y-m-d'));

        if ($request->filled('from') || $request->filled('to')) {
            $this->validate($request, [
                'from'  => 'required|date_format:Y-m-d',
                'to'    => 'required|date_format:Y-m-d|before_or_equal:' . date('Y-m-d'),
            ]);
            $from = Carbon::parse($request->from);
            $to = Carbon::parse($request->to);
        }
        $data = PaymentRequestModel::where('status_id', 4)
            ->whereBetween('date_pr', [$from, $to])
            ->orderBy('date_pr', 'asc')
            ->get();


        return view('report.payment', compact('data'))->with(['title' => $this->title_payment]);
    }
}
