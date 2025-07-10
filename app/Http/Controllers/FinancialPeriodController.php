<?php

namespace App\Http\Controllers;

use App\Models\FinancialPeriod;
use App\Models\OldProductsStock;
use App\Models\Products;
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
        $period = FinancialPeriod::where('status', 1)->count();

        if($period > 0){
            return redirect(route('financial_periods', absolute: false))->with('error', 'You can have only one active period at a time!!!');
        }

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
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        FinancialPeriod::find($request['id'])->update([
            'name' => $request['name'],
            'division' => get_logged_user_division_id(),
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'description' => $request['description'],
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        if($request['status'] == 2){
            $stores_ids = get_stores_ids(42);
            $product = Products::whereIn('division', $stores_ids)->get();
//            dd(count($product), $product);
            if(count($product) > 0){
                foreach($product as $p){
                    OldProductsStock::create([
                        'product_id' => $p->product_id,
                        'stock_date' => $request['end_date'],
                        'stock_in' => $p->stock_in,
                        'stock_out' => $p->stock_out,
                        'division' => $p->division,
                        'created_by_id' => get_logged_in_user_id(),
                        'updated_by_id' => get_logged_in_user_id(),
                    ]);
                }

                Products::whereIn('division', $stores_ids)->update([
                    'stock_in' => 0,
                    'stock_out' => 0
                ]);
            }

        }

        return redirect(route('financial_periods', absolute: false))->with('success', 'Financial Period Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        FinancialPeriod::find($request->id)->delete();

        return redirect(route('financial_periods', absolute: false))->with('success', 'Financial Period Deleted Successfully!!!');
    }
}
