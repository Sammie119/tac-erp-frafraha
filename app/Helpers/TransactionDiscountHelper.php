<?php
namespace App\Helpers;
use App\Models\Transaction;

class TransactionDiscountHelper {
    public static function transactionDiscount($trans)
    {
        if($trans->discount > 0) {
            if(get_logged_user_division_id() !== 42){
                $transaction = Transaction::find($trans->transaction_id);

                $discounted_amount = $transaction->without_tax_amount - $transaction->discount;

                $nhil = ($discounted_amount * (getTaxValue('nhil') / 100));
                $gehl = ($discounted_amount * (getTaxValue('gehl') / 100));
                $covid19 = ($discounted_amount * (getTaxValue('covid19') / 100));

                $sub_total = $discounted_amount + $nhil + $gehl + $covid19;

                $vat = ($sub_total * (getTaxValue('vat') / 100));

                $transaction->update([
                    'without_tax_amount' => $discounted_amount,
                    'taxable' => $transaction->taxable,
                    'nhil' => ($transaction->taxable == 1) ? $nhil : 0,
                    'gehl' => ($transaction->taxable == 1) ? $gehl : 0,
                    'covid19' => ($transaction->taxable == 1) ? $covid19 : 0,
                    'vat' => ($transaction->taxable == 1) ? $vat : 0,
                    'transaction_amount' => (($transaction->taxable == 1) ? $sub_total + $vat : $sub_total),
                    'discount' => $transaction->discount,
                ]);
            }
            else {
                $transaction = Transaction::find($trans->transaction_id);

                $discounted_amount = $transaction->without_tax_amount - $transaction->discount;

                $transaction->update([
                    'without_tax_amount' => $discounted_amount,
                    'taxable' => 0,
                    'nhil' => 0,
                    'gehl' => 0,
                    'covid19' => 0,
                    'vat' => 0,
                    'transaction_amount' => $discounted_amount,
                    'discount' => $transaction->discount,
                ]);
            }
        }

        return -1;
    }
}

