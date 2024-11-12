<?php

namespace App\Http\Controllers;

use App\Models\FinancialPeriod;
use Illuminate\Http\Request;

class FinancialPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['periods'] = FinancialPeriod::orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['periods'] = FinancialPeriod::where('division', get_logged_user_division_id())->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('stores.financial_periods', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:yesterday'],
        ]);

        FinancialPeriod::firstOrCreate([
            'name' => $request['name'],
            'division' => get_logged_user_division_id(),
            'start_date' => $request['start_date'],
        ],[
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'description' => $request['description'],
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('financial_periods', absolute: false))->with('success', 'Financial Period Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
