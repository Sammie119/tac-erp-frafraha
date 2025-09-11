<?php

namespace App\Http\Controllers;

use App\Models\Receivable;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['receivables'] = Receivable::orderbyDesc('id')->get();//paginate(30);
        } else {
            $data['receivables'] = Receivable::where('division', get_logged_user_division_id())->orderByDesc('id')->get();//paginate(30);
        }
        return view('stores.receivables', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd(request()->all());
        $request->validate([
            'supplier_name' => ['required'],
            'receivable' => ['required'],
            'receivable.*' => ['required'],
        ]);

        $supplier_id = Supplier::where('supplier_name', $request['supplier_name'])->first()->supplier_id;;

        foreach ($request->receivable as $product) {
            Receivable::create([
                'supplier_id' => $supplier_id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'unit_price' => $product['unit_price'],
                'amount' => $product['amount'],
                'description' => $product['description'],
                'division' => get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('receivables', absolute: false))->with('success', 'Receivables Created Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Receivable::find($request['id'])->delete();

        return redirect(route('receivables', absolute: false))->with('success', 'Receivables Deleted Successfully!!');
    }

}
