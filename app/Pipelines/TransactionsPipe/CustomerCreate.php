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
            if($cus === null){
                $cus = Customer::firstOrCreate(
                    [
                        'phone' => '0000000000',
                        'division' => get_logged_user_division_id(),
                    ],[
                    'name' => $transaction['customer'],
                    'address' => 'Address',
                    'email' => 'example@gmail.com',
                    'location' => 'location',
                    'created_by_id' => get_logged_in_user_id(),
                    'updated_by_id' => get_logged_in_user_id(),
                ]);
            }
        }

        $transaction['customer'] = $cus;

        return $next($transaction);
    }
}
