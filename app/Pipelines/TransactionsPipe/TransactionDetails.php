<?php

namespace App\Pipelines\TransactionsPipe;

use App\Models\TransactionDetail;

class TransactionDetails
{
    public function handle(array $transaction, \Closure $next)
    {
        foreach ($transaction['product_id'] as $i => $product) {

            TransactionDetail::create([
                'transaction_id' => $transaction['transaction_id'],
                'product_id' => $product,
                'quantity' => $transaction['quantity'][$i],
                'unit_price' => $transaction['unit_price'][$i],
                'amount' => $transaction['amount'][$i],
                'product_description' => (!empty($transaction['product_description'][$i])) ? $transaction['product_description'][$i] : null,
                'division' => get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return $next($transaction);
    }
}
