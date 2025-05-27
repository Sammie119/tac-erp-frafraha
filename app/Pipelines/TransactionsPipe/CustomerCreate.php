<?php

namespace App\Pipelines\TransactionsPipe;

use App\Models\Customer;

class CustomerCreate
{
    public function handle(array $transaction, \Closure $next)
    {
        if($transaction['customer'] === 'Add Customer'){
            $cus = Customer::firstOrCreate(
                [
                    'phone' => $transaction['phone'],
                    'division' => get_logged_user_division_id(),
                ],[
                'name' => $transaction['name'],
                'address' => $transaction['address'],
                'email' => $transaction['email'],
                'location' => $transaction['location'],
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        } else {
            $cus = Customer::where('name', $transaction['customer'])->first();
        }

        $transaction['customer'] = $cus;

        return $next($transaction);
    }
}
