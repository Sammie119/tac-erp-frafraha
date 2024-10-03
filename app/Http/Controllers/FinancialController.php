<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['financials'] = Financial::orderByDesc('transaction_date')->get();
        return view('financials.financials', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'transaction_name' => ['required'],
            'transaction_mode' => ['required'],
            'description' => ['required'],
            'division' => ['required'],
            'amount_paid_by' => ['required'],
            'amount' => ['required'],
            'transaction_date' => ['required'],
        ]);

        $count = DB::table('financial_transactions')->count() + 1;

        Financial::firstOrCreate([
            'name' => $request['transaction_name'],
            'transaction_date' => $request['transaction_date'],
            'amount' => $request['amount'],
        ],[
            'transaction_id' => invoice_num($count, 10, "TRN-"),
            'description' => $request['description'],
            'type' => $request['transaction_type'],
            'mode' => $request['transaction_mode'],
            'source' => $request['transaction_source'],
            'division' => $request['division'],
            'amount_paid_by' => $request['amount_paid_by'],
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('financials', absolute: false))->with('success', 'Financial Transaction Created Successfully!!!');
    }

    /**
     * Update a stored resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'transaction_name' => ['required'],
            'transaction_mode' => ['required'],
            'description' => ['required'],
            'division' => ['required'],
            'amount_paid_by' => ['required'],
            'amount' => ['required'],
            'transaction_date' => ['required'],
        ]);

        Financial::find($request['id'])->update([
            'name' => $request['transaction_name'],
            'transaction_date' => $request['transaction_date'],
            'amount' => $request['amount'],
            'description' => $request['description'],
            'type' => $request['transaction_type'],
            'mode' => $request['transaction_mode'],
            'source' => $request['transaction_source'],
            'division' => $request['division'],
            'amount_paid_by' => $request['amount_paid_by'],
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('financials', absolute: false))->with('success', 'Financial Transaction Updated Successfully!!!');
    }

    public function financialReport(Request $request)
    {
        return view('financials.financial_report');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $fn = Financial::find($request->id);

        $fn->delete();

        return redirect(route('financials', absolute: false))->with('success', 'Financial Transaction Deleted Successfully!!!');
    }
}
