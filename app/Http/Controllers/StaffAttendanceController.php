<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use App\Models\StaffAttendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['attendances'] = StaffAttendance::orderByDesc('attendance_date')->get();//paginate(30);
        } else {
            $data['attendances'] = StaffAttendance::where('division', get_logged_user_division_id())->orderByDesc('attendance_date')->get();//paginate(30);
        }
        return view('staff.attendance', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:1048',
        ]);

        Excel::import(new AttendanceImport, $request->file('file'));

        return redirect(route('attendance', absolute: false))->with('success', 'Staff Attendance Uploaded Successfully!!!');

    }

    public function export()
    {
        return Excel::download(new AttendanceExport(), 'attendance.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffAttendance $staffAttendance)
    {
        //
    }
}
