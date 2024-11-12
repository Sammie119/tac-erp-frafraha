<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['customers'] = Customer::orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['customers'] = Customer::where('division', get_logged_user_division_id())->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('customers.customers', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'location' => ['required'],
        ]);

        Customer::firstOrCreate(
            [
                'phone' => $request->phone,
                'division' => get_logged_user_division_id(),
            ],[
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'location' => $request->location,
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('customers', absolute: false))->with('success', 'Customer Created Successfully!!!');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'phone' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'location' => ['required'],
        ]);

        Customer::find($request->id)->update(
            [
            'phone' => $request->phone,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'location' => $request->location,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('customers', absolute: false))->with('success', 'Customer Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Customer::find($request->id)->delete();

        return redirect(route('customers', absolute: false))->with('success', 'Customer Deleted Successfully!!!');
    }
}
