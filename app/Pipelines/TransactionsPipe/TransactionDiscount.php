<?php

namespace App\Pipelines\TransactionsPipe;

use App\Helpers\TransactionDiscountHelper;

class TransactionDiscount
{
    public function handle(array $transaction, \Closure $next)
    {
        TransactionDiscountHelper::transactionDiscount($transaction);

        return $next($transaction);
    }
}
