<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['purchase_orders'] = PurchaseOrder::orderbyDesc('order_date')->get();//paginate(30);
        } else {
            $data['purchase_orders'] = PurchaseOrder::where('division', get_logged_user_division_id())->orderByDesc('order_date')->get();//paginate(30);
        }
        return view('product.purchase_orders', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'invoice_number' => ['required'],
            'order_date' => ['required'],
            'total_amount' => ['required'],
        ]);

        $supplier = Supplier::where('supplier_name', $request['supplier_name'])->first();
        if(!$supplier){
            return redirect(route('purchase_orders', absolute: false))->with('error', 'Supplier not found!!!!');
        }

//        dd($request->all());
        PurchaseOrder::firstOrCreate([
            'invoice_number' => $request['invoice_number'],
            'supplier_id' => $supplier->supplier_id,
            'total_amount' => $request['total_amount'],
        ],[
            'order_date' => $request['order_date'],
            'received_date' => $request['received_date'],
            'status' => $request['status'],
            'division' => get_logged_user_division_id(),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('purchase_orders', absolute: false))->with('success', 'Purchase Order Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $request->validate([
            'invoice_number' => ['required'],
            'order_date' => ['required'],
            'total_amount' => ['required'],
        ]);

        $supplier = Supplier::where('supplier_name', $request['supplier_name'])->first();
        if(!$supplier){
            return redirect(route('purchase_orders', absolute: false))->with('error', 'Supplier not found!!!!');
        }

//        dd($request->all());
        PurchaseOrder::find($request['id'])->update([
            'invoice_number' => $request['invoice_number'],
            'supplier_id' => $supplier->supplier_id,
            'total_amount' => $request['total_amount'],
            'order_date' => $request['order_date'],
            'received_date' => $request['received_date'],
            'status' => $request['status'],
            'created_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('purchase_orders', absolute: false))->with('success', 'Purchase Order Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        PurchaseOrder::find($request->id)->delete();

        return redirect(route('purchase_orders', absolute: false))->with('success', 'Purchase Order Deleted Successfully!!!');
    }
}
