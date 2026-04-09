<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ReturnedProduct;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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
            'invoice_no' => ['required']
        ]);

        $transaction = VWTransactions::where('invoice_no', $request['invoice_no'])->first();
        $products = TransactionDetail::where('transaction_id', $transaction->transaction_id)->get();

        if($transaction && $products){
            ReturnedProduct::firstOrCreate([
                'invoice_no' => $request['invoice_no'],
                'transaction_id' => $transaction->transaction_id,
            ],
            [
                'returned_date' => date('Y-m-d'),
                'amount_paid' => $transaction->amount_paid,
                'transaction_amount' => $transaction->transaction_amount,
                'reason' => $request['reason'],
                'division' => get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        } else {
            return redirect(route('returned_products', absolute: false))->with('error', 'Cannot find Invoice No!!');
        }

//        dd($transaction, $products, request()->all());

        foreach ($products as $product) {
//            dd($transaction, $product);
            $prod = Products::find($product['product_id']);

            $prod->update([
                'stock_in' => $prod->stock_in + $product['quantity'],
                'stock_out' => $prod->stock_out - $product['quantity'],
            ]);
        }

        Transaction::where('transaction_id', $transaction->transaction_id)->delete();
        TransactionDetail::where('transaction_id', $transaction->transaction_id)->delete();

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
