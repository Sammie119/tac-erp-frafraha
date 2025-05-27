<?php

namespace App\Http\Controllers;

use App\Helpers\StoresTransactionHelper;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionPayment;
use App\Models\VWTransactions;
use App\Helpers\TransactionDiscountHelper;
use App\Pipelines\TransactionsPipe\CustomerCreate;
use App\Pipelines\TransactionsPipe\ProcessPayment;
use App\Pipelines\TransactionsPipe\StoreTransaction;
use App\Pipelines\TransactionsPipe\TransactionDetails;
use App\Pipelines\TransactionsPipe\TransactionDiscount;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Pipeline;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function transactionsIndex()
    {
        if(get_logged_in_user_id() === 1){
            $data['transactions'] = VWTransactions::orderByDesc('transaction_id')->get();//paginate(30);
        } else {
            $data['transactions'] = VWTransactions::where('division', get_logged_user_division_id())->orderByDesc('transaction_id')->get();//paginate(30);
        }
        return view('transactions.transactions', $data);
    }

    public function transactionsStore(Request $request)
    {
//        $sms = SmsService::sendSms('24837616', 'Testing SMS Alert to a Foreign Number. Thank you');
//
//        dd('SMS', $sms);
//        dd($request->all());
        $request->validate([
            'taxable' => ['required'],
            'total_amount' => ['required'],
            'customer' => ['required'],
        ]);

        $transaction = Pipeline::send($request->all())->through(
            [
                CustomerCreate::class,
                StoreTransaction::class,
                TransactionDetails::class,
                TransactionDiscount::class,
                ProcessPayment::class,
            ]
        )->thenReturn();

//        if($request->customer === 'Add Customer'){
//            $cus = Customer::firstOrCreate(
//                [
//                    'phone' => $request->phone,
//                    'division' => get_logged_user_division_id(),
//                ],[
//                    'name' => $request->name,
//                    'address' => $request->address,
//                    'email' => $request->email,
//                    'location' => $request->location,
//                    'created_by_id' => get_logged_in_user_id(),
//                    'updated_by_id' => get_logged_in_user_id(),
//                ]);
//        } else {
//            $cus = Customer::where('name', $request->customer)->first();
//        }

//        $count = DB::table('transactions')->where('division', get_logged_user_division_id())->count() + 1;
//
//        $transaction = Transaction::firstOrCreate([
//            'invoice_no' => invoice_num($count, 10, "TAC-"),
//            'customer_id' => $cus->id,
//            'transaction_date' => $request->transaction_datedate,
//        ],[
//            'without_tax_amount' => $request->without_tax_amount,
//            'taxable' => $request->taxable,
//            'nhil' => ($request->taxable == 1) ? $request->nhil : 0,
//            'gehl' => ($request->taxable == 1) ? $request->gehl : 0,
//            'covid19' => ($request->taxable == 1) ? $request->covid19 : 0,
//            'vat' => ($request->taxable == 1) ? $request->vat : 0,
//            'transaction_amount' => $request->total_amount,
//            'discount' => $request->discount,
//            'customer_name_store' => $request->customer_name,
//            'division' => get_logged_user_division_id(),
//            'created_by_id' => get_logged_in_user_id(),
//            'updated_by_id' => get_logged_in_user_id(),
//        ]);

//        foreach ($request->product_id as $i => $product) {
//
//            TransactionDetail::create([
//                'transaction_id' => $transaction->transaction_id,
//                'product_id' => $product,
//                'quantity' => $request->quantity[$i],
//                'unit_price' => $request->unit_price[$i],
//                'amount' => $request->amount[$i],
//                'product_description' => (!empty($request->product_description[$i])) ? $request->product_description[$i] : null,
//                'division' => get_logged_user_division_id(),
//                'created_by_id' => get_logged_in_user_id(),
//                'updated_by_id' => get_logged_in_user_id(),
//            ]);
//        }

//        TransactionDiscountHelper::transactionDiscount($transaction);

       // Stores Receipt print
        if(get_logged_user_division_id() === 42  || get_logged_user_division_parent_id() == 42){
            if(!$request->has('checkbox')){
                $payment = StoresTransactionHelper::transactionStore($transaction, $request->payment_method);

                return "<script>
                    window.open('/invoice/$payment->id/receipt','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                    window.location.href = '/transactions';
                </script>";
            }
        }

        return redirect(route('transactions', absolute: false))->with('success', 'Transaction Created Successfully!!!');
    }

    public function transactionsUpdate(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'taxable' => ['required'],
            'total_amount' => ['required'],
            'customer' => ['required'],
        ]);

        if($request->customer === 'Add Customer'){
            $cus = Customer::firstOrCreate(
                [
                    'phone' => $request->phone,
                    'division' => get_logged_user_division_id(),
                ],
                [
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'location' => $request->location,
                    'created_by_id' => get_logged_in_user_id(),
                    'updated_by_id' => get_logged_in_user_id(),
                ]
            );
        } else {
            $cus = Customer::where('name', $request->customer)->first();
        }

        $check_payment = TransactionPayment::where(['transaction_id' => $request->id])->count();

        if($check_payment >= 1){
            return redirect(route('transactions', absolute: false))->with('error', 'Update not Allowed, Payment has Started!!!');
        }

//        $count = DB::table('transactions')->count() + 1;

        $transaction = Transaction::find($request->id);
        $transaction->update([
//            'invoice_no' => invoice_num($count, 10, "TAC-"),
            'customer_id' => $cus->id,
//            'transaction_date' => date('Y-m-d'),
            'without_tax_amount' => $request->without_tax_amount,
            'taxable' => $request->taxable,
            'nhil' => ($request->taxable == 1) ? $request->nhil : 0,
            'gehl' => ($request->taxable == 1) ? $request->gehl : 0,
            'covid19' => ($request->taxable == 1) ? $request->covid19 : 0,
            'vat' => ($request->taxable == 1) ? $request->vat : 0,
            'transaction_amount' => $request->total_amount,
            'product_description' => (!empty($request->product_description)) ? $request->product_description : null,
            'discount' => $request->discount,
            'customer_name_store' => $request->customer_name,
            'division' => get_logged_user_division_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        TransactionDetail::where(['transaction_id' => $request->id])->delete();
//        DB::table('transaction_details')->where(['transaction_id' => $request->id])->delete();

        foreach ($request->product_id as $i => $product) {

            TransactionDetail::create([
                'transaction_id' => $request->id,
                'product_id' => $product,
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'amount' => $request->amount[$i],
                'product_description' => $request->product_description[$i],
                'division' => get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        TransactionDiscountHelper::transactionDiscount($transaction);

        // Stores Receipt print
        if(get_logged_user_division_id() === 42  || get_logged_user_division_parent_id() == 42){
            $payment = StoresTransactionHelper::transactionStore($transaction, $request->payment_method);

            return "<script>
                window.open('/invoice/$payment->id/receipt','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                window.location.href = '/transactions';
            </script>";
        }

        return redirect(route('transactions', absolute: false))->with('success', 'Transaction Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function transactionsDestroy(Request $request)
    {
        $check_payment = TransactionPayment::where(['transaction_id' => $request->id])->count();

        if($check_payment >= 1){
            return redirect(route('transactions', absolute: false))->with('error', 'Delete not Allowed, Payment has Started!!!');
        }

//        dd($request->all());
        Transaction::find($request->id)->update([
            'updated_by_id' => get_logged_in_user_id()
        ]);

        TransactionDetail::where(['transaction_id' => $request->id])->delete();
//        DB::table('transaction_details')->where(['transaction_id' => $request->id])->delete();

        Transaction::find($request->id)->delete();

        return redirect(route('transactions', absolute: false))->with('success', 'Transaction Deleted Successfully!!!');

    }

    public function paymentsIndex()
    {
        if(get_logged_in_user_id() === 1){
            $data['payments'] = TransactionPayment::orderByDesc('transaction_id')->get();//paginate(30);
        } else {
            $data['payments'] = TransactionPayment::where('division', get_logged_user_division_id())->orderByDesc('transaction_id')->get();//paginate(30);
        }
        return view('transactions.payments', $data);
    }

    public function makePayment(Request $request)
    {
        $request->validate([
            'payment_method' => ['required'],
            'transaction_id' => ['required'],
            'paid_amount' => ['required'],
        ]);

        $division = (!empty($request->division)) ? $request->division : get_logged_user_division_id();
        $count = DB::table('transaction_payments')->where('division', $division)->count() + 1;

        foreach ($request['transaction_id'] as $i => $transaction_id) {
            $transaction = VWTransactions::find($transaction_id);

            if($transaction->status !== 'Paid'){

                TransactionPayment::firstOrCreate([
                    'transaction_id' => $transaction_id,
                    'invoice_no' => $transaction->invoice_no,
                    'payment_date' => date('Y-m-d'),
                    'amount_paid' => $request['paid_amount'][$i],
                ],[
                    'receipt_no' => invoice_num($count, 10, "TAC-"),
                    'total_amount' => $transaction->transaction_amount,
                    'balance' => floatval($transaction->balance - $request['paid_amount'][$i]),
                    'payment_method' => $request->payment_method,
                    'paid_balance' => $transaction->balance,
                    'division' => $division,
                    'created_by_id' => get_logged_in_user_id(),
                    'updated_by_id' => get_logged_in_user_id(),
                ]);

            }
        }

        return redirect(route('payments', absolute: false))->with('success', 'Payment Create Successfully!!!');
    }

    public function makeSinglePayment(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'payment_method' => ['required'],
            'transaction_id' => ['required'],
            'paid_amount' => ['required'],
        ]);

//        dd($request->all());

        $count = DB::table('transaction_payments')->count() + 1;

        $transaction = VWTransactions::find($request['transaction_id']);

        if($transaction->status !== 'Paid') {

            TransactionPayment::firstOrCreate([
                'transaction_id' => $request['transaction_id'],
                'invoice_no' => $transaction->invoice_no,
                'payment_date' => date('Y-m-d'),
                'amount_paid' => $request['paid_amount'],
            ], [
                'receipt_no' => invoice_num($count, 10, "TAC-"),
                'total_amount' => $transaction->transaction_amount,
                'balance' => floatval($transaction->balance - $request['paid_amount']),
                'payment_method' => $request->payment_method,
                'paid_balance' => $transaction->balance,
                'division' => (!empty($request->division)) ? $request->division : get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('payments', absolute: false))->with('success', 'Payment Create Successfully!!!');
    }

    public function paymentUpdate(Request $request)
    {
        $request->validate([
            'payment_method' => ['required'],
            'transaction_id' => ['required'],
            'paid_amount' => ['required'],
        ]);

        $transactionDetails = TransactionPayment::find($request->id);

        if(strtotime($transactionDetails->created_at->format('Y-m-d')) !== strtotime(date('Y-m-d'))){
            return redirect(route('payments', absolute: false))->with('error', 'Payment Cannot be Updated!!!');
        }

        $transaction = VWTransactions::find($request->transaction_id);

        $transactionDetails->update([
            'transaction_id' => $request->transaction_id,
            'invoice_no' => $transaction->invoice_no,
            'amount_paid' => $request['paid_amount'],
            'total_amount' => $transaction->transaction_amount,
            'balance' => floatval(($transaction->balance + $transactionDetails->amount_paid) - $request['paid_amount']),
            'payment_method' => $request->payment_method,
            'division' => (!empty($request->division)) ? $request->division : get_logged_user_division_id(),
//            'paid_balance' => floatval(($transaction->balance + $transactionDetails->amount_paid) - $request['paid_amount']),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('payments', absolute: false))->with('success', 'Payment Updated Successfully!!!');
    }

    public function paymentDestroy(Request $request)
    {
        $payments = TransactionPayment::find($request->id);

        $check_payment = TransactionPayment::where(['transaction_id' => $payments->transaction_id])->orderByDesc('id')->first();

//        dd((int)$request->id, $check_payment->id);
        if((int)$request->id !== $check_payment->id){
            return redirect(route('payments', absolute: false))->with('error', 'Delete not Allowed, Payment has Started!!!');
        }

        $payments->delete();

        return redirect(route('payments', absolute: false))->with('success', 'Payment Deleted Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function invoice($transaction_id, $type)
    {
//        dd($type);
        $data['type'] = $type;
        if($type == 'invoice'){
            $data['transaction'] = Transaction::find($transaction_id);
            $data['transaction_details'] = TransactionDetail::where('transaction_id', $transaction_id)->get();
            $data['location'] = 'transactions';
            return view('transactions.invoice', $data);
        } else {
            $data['payment'] = TransactionPayment::find($transaction_id);
            $data['transaction'] = Transaction::find($data['payment']->transaction_id);
            $data['transaction_details'] = TransactionDetail::where('transaction_id', $data['payment']->transaction_id)->get();
            $data['location'] = 'payments';
            return view('transactions.invoice', $data);
        }
    }

    public function invoicePdf($id, $location)
    {
        if($location == 'transactions') {
            $data['type'] = 'invoice';
            $data['transaction'] = Transaction::find($id);
            $data['transaction_details'] = TransactionDetail::where('transaction_id', $id)->get();
            $pdf = Pdf::loadView('transactions.download_invoice', $data)->setPaper('a4', 'portrait');
            return $pdf->download('invoice_' . $data['transaction']->invoice_no . '.pdf');
        } else {
//            dd('Receipt_PDF');
            $data['type'] = 'receipt';
            $data['payment'] = TransactionPayment::find($id);
            $data['transaction'] = Transaction::find($data['payment']->transaction_id);
            $data['transaction_details'] = TransactionDetail::where('transaction_id', $data['payment']->transaction_id)->get();
            $pdf = Pdf::loadView('transactions.download_invoice', $data)->setPaper('a4', 'portrait');
            return $pdf->download('receipt_' . $data['payment']->receipt_no . '.pdf');
        }
    }

    public function invoicePrint($id, $location)
    {
        switch ($location) {
            case 'transactions':
                return "<script>
                        window.open('/invoice/$id/invoice','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                        window.location.href = '/$location';
                    </script>";

            case 'payments':
                return "<script>
                        window.open('/invoice/$id/receipt','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                        window.location.href = '/$location';
                    </script>";

            case 'waybills':
                return "<script>
                        window.open('/print_waybill/$id','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0');
                        window.location.href = '/$location';
                    </script>";

            default:
                return "No Payment Found";
        }

    }

}
