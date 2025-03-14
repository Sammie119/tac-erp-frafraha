<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\TransactionPayment;
use App\Models\VWTransactions;
use Illuminate\Http\Request;

class GetAjaxCallController extends Controller
{
    public function getSearchProduct(Request $request)
    {
        $user_in_id = get_logged_user_division_id();
        $product = Products::where(["name" => $request->search, 'division' => $user_in_id])->first();

        if($product){
            $results = [
                'stock' => $product->stock_in - $product->stock_out,
//                'product_name' => $product->name,
                'product_description' => $product->name.' ('.$product->stock_in - $product->stock_out.')',
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

    public function getSalesReceived(Request $request)
    {
//        dd($request->all());
        $sum_sales = TransactionPayment::where('division', get_logged_user_division_id())
            ->whereBetween('payment_date', [$request->start_date, $request->end_date])
            ->sum('amount_paid');

//        dd($sum_sales);

        return response()->json($sum_sales);
    }

}
