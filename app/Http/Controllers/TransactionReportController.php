<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $data['report'] = 'Daily Income Report';
        $data['header'] = 'DAILY SALES REPORT';

//        dd($data);

        return view('reports.print_report', $data);
    }

    public function invoiceReport(Request $request)
    {
        $request->validate([
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        $data['data_payment'] = TransactionPayment::selectRaw("updated_by_id, sum(amount_paid) as amount")->where('division', get_logged_user_division_id())
            ->whereBetween('payment_date', [$request->from_date, $request->to_date])
            ->groupBy('updated_by_id')->get();

        $data['data'] = Transaction::where('division', get_logged_user_division_id())->whereBetween('transaction_date', [$request->from_date, $request->to_date])
            ->get();

        $data['date'] = [
            'from' => $request->from_date,
            'to' => $request->to_date,
        ];
        $data['report'] = 'Receipt Report';
        $data['header'] = 'Daily Income Report';

        return view('reports.print_report', $data);

    }
}
