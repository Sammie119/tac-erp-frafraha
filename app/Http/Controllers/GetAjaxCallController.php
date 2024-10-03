<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\VWTransactions;
use Illuminate\Http\Request;

class GetAjaxCallController extends Controller
{
    public function getSearchProduct(Request $request)
    {
        $product = Products::where("name", $request->search)->first();

        if($product){
            $results = [
                'stock' => $product->stock_in - $product->stock_out,
//                'product_name' => $product->name,
                'product_description' => $product->name,
                'cost' => $product->cost,
                'price' => $product->price,
                'product_id' => $product->product_id,
            ];
        }
        else{
            $results = [
                'product_name' => 'No_data'
            ];
        }

        return response()->json($results);
    }

    public function getSearchInvoice(Request $request)
    {
        $transaction = VWTransactions::where("invoice_no", $request->search)->first();

        if($transaction){
            $results = [
                'transaction_id' => $transaction->transaction_id,
                'invoice_no' => $transaction->invoice_no,
                'customer_name' => $transaction->customer_name,
                'transaction_date' => $transaction->transaction_date,
                'without_tax_amount' => $transaction->without_tax_amount,
                'taxable' => $transaction->taxable,
                'nhil' => $transaction->nhil,
                'gehl' => $transaction->gehl,
                'covid19' => $transaction->covid19,
                'vat' => $transaction->vat,
                'transaction_amount' => ($transaction->amount_paid == 0.00) ? $transaction->transaction_amount : floatval($transaction->transaction_amount - $transaction->amount_paid),
                'amount_paid' => $transaction->amount_paid,
                'status' => $transaction->status,
                'division' => $transaction->division,
            ];
        }
        else{
            $results = [
                'product_name' => 'No_data'
            ];
        }

        return response()->json($results);
    }

}
