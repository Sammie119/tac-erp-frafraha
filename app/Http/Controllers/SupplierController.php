<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['suppliers'] = Supplier::orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['suppliers'] = Supplier::where('division', get_logged_user_division_id())->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('product.suppliers', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'supplier_name' => ['required'],
            'supplier_address' => ['required'],
            'contact_name' => ['required'],
        ]);

        Supplier::firstOrCreate([
            'supplier_name' => $request['supplier_name'],
            'division' => get_logged_user_division_id()
        ],[
            'supplier_address' => $request['supplier_address'],
            'supplier_phone' => $request['supplier_phone'],
            'supplier_email' => $request['supplier_email'],
            'contact_name' => $request['contact_name'],
            'contact_phone' => $request['contact_phone'],
            'contact_email' => $request['contact_email'],
            'supplier_tin_number' => $request['supplier_tin_number'],
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('suppliers', absolute: false))->with('success', 'Supplier Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $request->validate([
             'supplier_name' => ['required'],
             'supplier_address' => ['required'],
             'contact_name' => ['required'],
        ]);

        $product = Supplier::find($request->id);
        $product->update([
            'supplier_name' => $request['supplier_name'],
            'supplier_address' => $request['supplier_address'],
            'supplier_phone' => $request['supplier_phone'],
            'supplier_email' => $request['supplier_email'],
            'contact_name' => $request['contact_name'],
            'contact_phone' => $request['contact_phone'],
            'contact_email' => $request['contact_email'],
            'supplier_tin_number' => $request['supplier_tin_number'],
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('suppliers', absolute: false))->with('success', 'Supplier Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Supplier::find($request->id)->delete();

        return redirect(route('suppliers', absolute: false))->with('success', 'Supplier Deleted Successfully!!!');
    }
}
