<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionReportController extends Controller
{
    public function index()
    {
        return view('transactions.transaction_report');
    }

    public function invoiceReport(Request $request)
    {
        $request->validate([
            'from_date' => ['required', 'date', 'before:to_date'],
            'to_date' => ['required', 'date', 'after:from_date'],
        ]);

        dd($request->all());
    }
}
