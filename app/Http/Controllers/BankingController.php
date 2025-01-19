<?php

namespace App\Http\Controllers;

use App\Models\Banking;
use Illuminate\Http\Request;

class BankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['sales'] = Banking::orderByDesc('id')->get();//paginate(30);
        } else {
            $data['sales'] = Banking::where('division', get_logged_user_division_id())->orderByDesc('id')->get();//paginate(30);
        }
        return view('financials.banking.bank_entry', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function salesBankingStore(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'start_date' => ['required'],
            'end_date' => ['required'],
            'amount_received' => ['required'],
            'amount_banked' => ['required'],
            'image_url' => ['required', 'file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->file('image_url') != null){
            $request['file_url'] = $this->imageUpload($request->file('image_url'), 'bank_files');
        }

        Banking::firstOrCreate(
            [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'amount_received' => $request->amount_received,
                'amount_banked' => $request->amount_banked,
                'division' => get_logged_user_division_id(),
            ],
            [
                'image_url' => $request->file_url,
                'status' => 0, //$request->status,
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('sales_banking', absolute: false))->with('success', 'Sales Entry Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function salesBankingUpdate(Request $request)
    {
//                dd(Banking::find($request->id));
        $request->validate([
            'start_date' => ['required'],
            'end_date' => ['required'],
            'amount_received' => ['required'],
            'amount_banked' => ['required'],
            'status' => ['required'],
            'remarks' => ['required'],
            'image_url' => ['nullable', 'file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $sale = Banking::find($request->id);

        if($request->file('image_url') != null){
            $request['file_url'] = $this->imageUpload($request->file('image_url'), 'bank_files', $sale->image_url);
        }

        $sale->update(
            [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'amount_received' => $request->amount_received,
                'amount_banked' => $request->amount_banked,
                'image_url' => ($request->file('image_url') != null) ? $request->file_url : $sale->image_url,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'updated_by_id' => get_logged_in_user_id(),
            ]
        );

        return redirect(route('sales_banking', absolute: false))->with('success', 'Sales Entry Updated/Approved Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function salesBankingDestroy(Request $request)
    {
//        dd($request->all());
        Banking::find($request->id)->delete();

        return redirect(route('sales_banking', absolute: false))->with('success', 'Sales Entry Deleted Successfully!!!');
    }
}
