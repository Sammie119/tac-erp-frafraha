<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\RestockProduct;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionPayment;
use App\Models\VWTransactions;
use Illuminate\Http\Request;

class TransactionReportController extends Controller
{
    public function index()
    {
        return view('transactions.transaction_report');
    }

    public function dailyIncomeReport(Request $request)
    {
        $request->validate([
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        $payments = [];
        if(get_logged_user_division_id() === 42){
            $stores_ids = get_stores_ids(42);

            if($request->location === 'All'){
                $users = TransactionPayment::select('updated_by_id')->whereIn('division', $stores_ids)
                    ->whereBetween('payment_date', [$request->from_date, $request->to_date])->get()->unique('updated_by_id');

                foreach ($users as $user) {
                    $payments[] = TransactionPayment::whereIn('division', $stores_ids)
                        ->whereBetween('payment_date', [$request->from_date, $request->to_date])
                        ->where('updated_by_id', $user->updated_by_id)
                        ->orderByDesc('transaction_id')->get();
                }

            }else {
                $users = TransactionPayment::select('updated_by_id')->where('division', $request->location)
                    ->whereBetween('payment_date', [$request->from_date, $request->to_date])->get()->unique('updated_by_id');

                foreach ($users as $user) {
                    $payments[] = TransactionPayment::where('division', $request->location)
                        ->whereBetween('payment_date', [$request->from_date, $request->to_date])
                        ->where('updated_by_id', $user->updated_by_id)
                        ->orderByDesc('transaction_id')->get();
                }
            }

        } else {
            $users = TransactionPayment::select('updated_by_id')->where('division', get_logged_user_division_id())
                ->whereBetween('payment_date', [$request->from_date, $request->to_date])->get()->unique('updated_by_id');

            foreach ($users as $user) {
                $payments[] = TransactionPayment::where('division', get_logged_user_division_id())
                    ->whereBetween('payment_date', [$request->from_date, $request->to_date])
                    ->where('updated_by_id', $user->updated_by_id)
                    ->orderByDesc('transaction_id')->get();
            }
        }

        $data['users'] = $payments;

        $data['date'] = [
            'from' => $request->from_date,
            'to' => $request->to_date,
        ];
        $data['report'] = 'Income Report';
        $data['header'] = 'SALES REPORT';

//        dd($data);

        return view('reports.print_report', $data);
    }

    public function invoiceReport(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        $payments = [];
        if(get_logged_user_division_id() === 42){
            $stores_ids = get_stores_ids(42);

            if($request->location === 'All'){
                $users = TransactionPayment::select('updated_by_id')->whereIn('division', $stores_ids)
                    ->whereBetween('payment_date', [$request->from_date, $request->to_date])->get()->unique('updated_by_id');

                foreach ($users as $user) {
                    $payments[] = TransactionPayment::whereIn('division', $stores_ids)
                        ->whereBetween('payment_date', [$request->from_date, $request->to_date])
                        ->where('updated_by_id', $user->updated_by_id)
                        ->orderByDesc('transaction_id')->get();
                }

            }else {
                $users = TransactionPayment::select('updated_by_id')->where('division', $request->location)
                    ->whereBetween('payment_date', [$request->from_date, $request->to_date])->get()->unique('updated_by_id');

                foreach ($users as $user) {
                    $payments[] = TransactionPayment::where('division', $request->location)
                        ->whereBetween('payment_date', [$request->from_date, $request->to_date])
                        ->where('updated_by_id', $user->updated_by_id)
                        ->orderByDesc('transaction_id')->get();
                }
            }

        } else {
            $users = TransactionPayment::select('updated_by_id')->where('division', get_logged_user_division_id())
                ->whereBetween('payment_date', [$request->from_date, $request->to_date])->get()->unique('updated_by_id');

            foreach ($users as $user) {
                $payments[] = TransactionPayment::where('division', get_logged_user_division_id())
                    ->whereBetween('payment_date', [$request->from_date, $request->to_date])
                    ->where('updated_by_id', $user->updated_by_id)
                    ->orderByDesc('transaction_id')->get();
            }
        }

        $data['users'] = $payments;

        $data['date'] = [
            'from' => $request->from_date,
            'to' => $request->to_date,
        ];
        $data['report'] = 'Detailed Report';
        $data['header'] = 'DETAILED SALES REPORT';

        return view('reports.print_report', $data);

    }

    public function productReport(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        $data['date'] = [
            'from' => $request->from_date,
            'to' => $request->to_date,
        ];

        $data['product'] = Products::where('name', $request->product)->first();

        $data['restock'] = RestockProduct::where('division', get_logged_user_division_id())
            ->where('product_id', $data['product']->product_id)
            ->whereBetween('updated_at', [$request->from_date, $request->to_date])
            ->get();

        $data['payments'] = TransactionPayment::select('transaction_payments.*', 'transaction_details.product_id', 'transaction_details.quantity', 'transaction_details.unit_price', 'transaction_details.amount')
            ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transaction_payments.transaction_id')
            ->where('transaction_payments.division', get_logged_user_division_id())
            ->where('transaction_details.product_id', $data['product']->product_id)
            ->whereBetween('payment_date', [$request->from_date, $request->to_date])
            ->get();

        $data['report'] = 'Product Report';
        $data['header'] = 'PRODUCT DETAIL REPORT';

        return view('reports.print_report', $data);

    }

    public function productsExportReport(Request $request)
    {
        $data['report'] = 'Product Export Report';
        $data['header'] = 'PRODUCT STATE REPORT';

        $data['products'] = Products::where(['type' => $request->category, 'division' => get_logged_user_division_id()])->get();

        return view('reports.print_report', $data);
    }
}
