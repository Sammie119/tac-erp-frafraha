<?php

namespace App\Http\Controllers;

use App\Models\StoresTransfer;
use Illuminate\Http\Request;

class StoresTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['transfers'] = StoresTransfer::orderByDesc('store_transfer_id')->groupBy('store_transfer_id')->get();//paginate(30);
        } else {
            $data['transfers'] = StoresTransfer::distinct('store_transfer_id')->where('division', get_logged_user_division_id())->orderByDesc('store_transfer_id')
                ->groupBy('store_transfer_id', 'id')->get();//paginate(30);
        }
        return view('product.stores_transfer', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
            'stock' => ['required'],
            'transfer_quantity' => ['required'],
            //'approved_quantity' => ['required'],
            'transfer_date' => ['required'],
            'from_store_id' => ['required'],
            'to_store_id' => ['required'],
        ]);

//        dd($request->all());
        $count = StoresTransfer::count();

        if($count > 0){
            $count = StoresTransfer::select('store_transfer_id')->orderByDesc('store_transfer_id')->first()->store_transfer_id;
        }

        foreach ($request->product_id as $key => $product_id) {
            StoresTransfer::firstOrCreate(
                [
                    'transfer_date' => $request->transfer_date,
                    'from_store_id' => $request->from_store_id,
                    'to_store_id' => $request->to_store_id,
                    'product_id' => $product_id,
                    'transfer_quantity' => $request->transfer_quantity[$key],
                    'division' => get_logged_user_division_id(),
                ],
                [
                    'store_transfer_id' => $count + 1,
                    'old_stock' => $request->stock[$key],
//                    'approved_quantity' => get_logged_in_user_id(),
//                    'new_stock' => get_logged_in_user_id(),
                    'status' => 0,
//                    'remarks' => 0, //$request->status,
                    'created_by_id' => get_logged_in_user_id(),
                    'updated_by_id' => get_logged_in_user_id(),
                ]
            );
        }

        return redirect(route('stores_transfer', absolute: false))->with('success', 'Stock Transfer Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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

        $sale = StoresTransfer::find($request->id);

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

        return redirect(route('stores_transfer', absolute: false))->with('success', 'Sales Entry Updated/Approved Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //        dd($request->all());
        StoresTransfer::find($request->id)->delete();

        return redirect(route('stores_transfer', absolute: false))->with('success', 'Sales Entry Deleted Successfully!!!');
    }
}
