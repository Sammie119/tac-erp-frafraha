<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ReturnedProduct;
use App\Models\VWTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['products'] = ReturnedProduct::orderbyDesc('returned_date')->get();//paginate(30);
        } else {
            $data['products'] = ReturnedProduct::where('division', get_logged_user_division_id())->orderByDesc('returned_date')->get();//paginate(30);
        }
        return view('transactions.returned_products', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd(request()->all());
        $request->validate([
            'invoice_no' => ['required'],
            'returned_product' => ['required'],
            'returned_product.*' => ['required'],
        ]);

        $transaction_id = VWTransactions::where('invoice_no', $request['invoice_no'])->first()->transaction_id;;

        foreach ($request->returned_product as $product) {
            $prod = Products::find($product['product_id']);

            if($prod){
                ReturnedProduct::create([
                    'invoice_no' => $request['invoice_no'],
                    'product_id' => $product['product_id'],
                    'transaction_id' => $transaction_id,
                    'returned_date' => date('Y-m-d'),
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['unit_price'],
                    'amount' => $product['amount'],
                    'reason' => $product['reason'],
                    'division' => get_logged_user_division_id(),
                    'created_by_id' => get_logged_in_user_id(),
                    'updated_by_id' => get_logged_in_user_id(),
                ]);

                $prod->update([
                    'stock_in' => $prod->stock_in + $product['quantity'],
                    'stock_out' => $prod->stock_out - $product['quantity'],
                ]);
            }
        }

        return redirect(route('returned_products', absolute: false))->with('success', 'Requisition Created Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $return = ReturnedProduct::find($request['id']);
        if($return){
            $prod = Products::find($return->product_id);
            $prod->update([
                'stock_in' => $prod->stock_in - $return->quantity,
                'stock_out' => $prod->stock_out + $return->quantity,
            ]);

            $return->delete();
        }

        return redirect(route('returned_products', absolute: false))->with('success', 'Requisition Deleted Successfully!!');
    }

}
