<?php

namespace App\Http\Controllers;

use App\Models\TransactionPayment;
use Illuminate\Http\Request;

class TransactionReportController extends Controller
{
    public function index()
    {
        return view('transactions.transaction_report');
    }

    public function dailyIncomeReport(Request $request)
    {
        $request->validate([
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        $data['data'] = TransactionPayment::selectRaw("updated_by_id, sum(amount_paid) as amount")->where('division', get_logged_user_division_id())
            ->whereBetween('payment_date', [$request->from_date, $request->to_date])
            ->groupBy('updated_by_id')->get();

        $data['report'] = 'Daily Income Report';
        $data['header'] = 'Daily Income Report';

        return view('reports.print_report', $data);
    }

    public function invoiceReport(Request $request)
    {
        $request->validate([
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        dd($request->all());
    }
}
