<?php

namespace App\Pipelines\TransactionsPipe;

use App\Helpers\StoresTransactionHelper;
use Illuminate\Support\Arr;

class ProcessPayment
{
    public function handle(array $transaction, \Closure $next)
    {
        return $next($transaction);
    }
}
