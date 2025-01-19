<?php
namespace App\Helpers;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionPayment;
use App\Models\VWTransactions;
use Illuminate\Support\Facades\DB;

class StoresTransactionHelper {
    public static function transactionStore($transaction, $payment_method)
    {
        $count = DB::table('transaction_payments')->where('division', 42)->count() + 1;

        $transaction = VWTransactions::find($transaction->transaction_id);

//        dd($transaction);

        if($transaction->status !== 'Paid'){

            $payment = TransactionPayment::firstOrCreate([
                'transaction_id' => $transaction->transaction_id,
                'invoice_no' => $transaction->invoice_no,
                'payment_date' => date('Y-m-d'),
                'amount_paid' => $transaction->without_tax_amount,
            ],[
                'receipt_no' => invoice_num($count, 10, "TAC-"),
                'total_amount' => $transaction->without_tax_amount,
                'balance' => 0.00,
                'payment_method' => $payment_method,
                'paid_balance' => $transaction->without_tax_amount,
                'division' => 42,
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);

        }

        return $payment;
    }
}

