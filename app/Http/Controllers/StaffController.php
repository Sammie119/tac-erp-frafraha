<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\VWStaff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['staff'] = VWStaff::orderBy('full_name')->get();//paginate(30);
        } else {
            $data['staff'] = VWStaff::where('division', get_logged_user_division_id())->orderBy('full_name')->get();//paginate(30);
        }
        return view('staff.staff', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        // dd($request->all());
        $request->validate([
            'firstname' => ['required', 'string'],
            'staff_number' => ['required'],
            'othernames' => ['required'],
            'date_of_birth' => ['required'],
            'phone' => ['required'],
            'email' => ['email']
        ]);

        Staff::firstOrCreate([
            'staff_number' => $request['staff_number'],
            ],[
            'title' => $request['title'],
            'gender' => $request['gender'],
            'firstname' => $request['firstname'],
            'othernames' => $request['othernames'],
            'date_of_birth' => $request['date_of_birth'],
            'married' => $request['married'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'address' => $request['address'],
            'position' => $request['position'],
            'banker' => $request['banker'],
            'bank_account' => $request['bank_account'],
            'bank_branch' => $request['bank_branch'],
            'bank_sort_code' => $request['bank_sort_code'],
            'ghana_card' => $request['ghana_card'],
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('staff', absolute: false))->with('success', 'Staff Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string'],
            'staff_number' => ['required'],
            'othernames' => ['required'],
            'date_of_birth' => ['required'],
            'phone' => ['required'],
            'email' => ['email']
        ]);
        $staff = Staff::find($request->id);
        // dd($staff);
        $staff->update([
            'staff_number' => $request['staff_number'],
            'title' => $request['title'],
            'gender' => $request['gender'],
            'firstname' => $request['firstname'],
            'othernames' => $request['othernames'],
            'date_of_birth' => $request['date_of_birth'],
            'phone' => $request['phone'],
            'married' => $request['married'],
            'email' => $request['email'],
            'address' => $request['address'],
            'position' => $request['position'],
            'banker' => $request['banker'],
            'bank_account' => $request['bank_account'],
            'bank_branch' => $request['bank_branch'],
            'bank_sort_code' => $request['bank_sort_code'],
            'ghana_card' => $request['ghana_card'],
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('staff', absolute: false))->with('success', 'Staff Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request->id);
        Staff::find($request->id)->delete();

        return redirect(route('staff', absolute: false))->with('success', 'Staff deleted Successfully!!!');
    }
}
