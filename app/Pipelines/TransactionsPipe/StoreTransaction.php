<?php

namespace App\Pipelines\TransactionsPipe;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class StoreTransaction
{
    public function handle(array $transaction, \Closure $next)
    {
        $count = DB::table('transactions')->where('division', get_logged_user_division_id())->count() + 1;

       $trans =  Transaction::firstOrCreate([
            'invoice_no' => invoice_num($count, 10, "TAC-"),
            'customer_id' => $transaction['customer']->id,
            'transaction_date' => $transaction['transaction_date'],
        ],[
            'without_tax_amount' => $transaction['without_tax_amount'],
            'taxable' => $transaction['taxable'],
            'nhil' => ($transaction['taxable'] == 1) ? $transaction['nhil'] : 0,
            'gehl' => ($transaction['taxable'] == 1) ? $transaction['gehl'] : 0,
            'covid19' => ($transaction['taxable'] == 1) ? $transaction['covid19'] : 0,
            'vat' => ($transaction['taxable'] == 1) ? $transaction['vat'] : 0,
            'transaction_amount' => $transaction['total_amount'],
            'discount' => $transaction['discount'],
            'customer_name_store' => $transaction['customer_name'],
            'division' => get_logged_user_division_id(),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        $transaction['transaction_id'] = $trans->transaction_id;

        return $next($transaction);
    }
}
