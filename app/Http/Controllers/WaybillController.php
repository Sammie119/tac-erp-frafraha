<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use App\Models\Waybill;
use App\Models\WaybillDetails;
use Illuminate\Http\Request;

class WaybillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['waybills'] = Waybill::orderbyDesc('bill_date')->get();//paginate(30);
        return view('transactions.waybills', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required'],
            'remarks' => ['required'],
            'product_id.*' => ['required'],
            'quantity.*' => ['required'],
            'remarks.*' => ['required'],
            'customer' => ['required', 'exists:App\Models\Customer,name'],
            'job' => ['required', 'exists:App\Models\Project,name'],
            'vehicle_no' => ['required'],
            'driver_name' => ['required'],
            'bill_date' => ['required'],
        ]);

        $customer = Customer::where('name', $request['customer'])->first()->id;

        $waybill = Waybill::create([
            'customer_id' => $customer,
            'job' => $request['job'],
            'vehicle_no' => $request['vehicle_no'],
            'driver_name' => $request['driver_name'],
            'bill_date' => $request['bill_date'],
            'division' => get_logged_user_division_id(),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        foreach ($request->product_id as $i => $product) {
//            $prod = Products::find($product);

            WaybillDetails::create([
                'waybill_id' => $waybill->bill_id,
                'product_id' => $product,
                'quantity' => $request['quantity'][$i],
                'remarks' => $request['remarks'][$i],
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('waybills', absolute: false))->with('success', 'Waybill Created Successfully!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required'],
            'remarks' => ['required'],
            'product_id.*' => ['required'],
            'quantity.*' => ['required'],
            'remarks.*' => ['required'],
            'customer' => ['required', 'exists:App\Models\Customer,name'],
            'job' => ['required', 'exists:App\Models\Project,name'],
            'vehicle_no' => ['required'],
            'driver_name' => ['required'],
            'bill_date' => ['required'],
        ]);

        $customer = Customer::where('name', $request['customer'])->first()->id;

        $waybill = Waybill::find($request['id']);
        $waybill->update([
            'customer_id' => $customer,
            'job' => $request['job'],
            'vehicle_no' => $request['vehicle_no'],
            'driver_name' => $request['driver_name'],
            'bill_date' => $request['bill_date'],
            'division' => get_logged_user_division_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        WaybillDetails::where('waybill_id', $waybill->bill_id)->delete();

        foreach ($request->product_id as $i => $product) {
//            $prod = Products::find($product);

            WaybillDetails::create([
                'waybill_id' => $waybill->bill_id,
                'product_id' => $product,
                'quantity' => $request['quantity'][$i],
                'remarks' => $request['remarks'][$i],
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('waybills', absolute: false))->with('success', 'Waybill Updated Successfully!!');
    }

    public function printWaybill($waybill_id)
    {
        $data['waybill'] = Waybill::find($waybill_id);
        $data['waybill_details'] = WaybillDetails::where('waybill_id', $waybill_id)->get();
        $data['type'] = 'waybill';
        return view('transactions.invoice', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $waybill = Waybill::find($request['id']);
        WaybillDetails::where('waybill_id', $waybill->bill_id)->delete();
        $waybill->delete();

        return redirect(route('waybills', absolute: false))->with('success', 'Waybill Deleted Successfully!!');
    }
}
