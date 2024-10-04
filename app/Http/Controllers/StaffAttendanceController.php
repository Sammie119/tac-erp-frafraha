<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use App\Models\StaffAttendance;
use App\Models\StaffAttendanceDetail;
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
            $data['attendances'] = StaffAttendance::orderByDesc('attendance_id')->get();//paginate(30);
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
            'att_month' => 'required|string|max:20',
            'att_year' => 'required|integer|max:3024',
        ]);

        Excel::import(new AttendanceImport, $request->file('file'));

//        dd($request->all());
        $att = StaffAttendance::firstOrCreate([
            'month' => $request['att_month'],
            'year' => $request['att_year'],
            'division' => get_logged_user_division_id()
        ],[
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        StaffAttendanceDetail::where(['month' => null, 'year' => null])->update([
            'attendance_id' => $att->attendance_id,
            'month' => $att->month,
            'year' => $att->year,
        ]);

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
    public function destroy(Request $request)
    {
//        dd($request->all());
        $att = StaffAttendance::find($request->id);

        if($att){
            StaffAttendanceDetail::where(['attendance_id' => $att->attendance_id])->delete();

            $att->delete();
        }

        return redirect(route('attendance', absolute: false))->with('success', 'Attendance Deleted Successfully!!!');
    }
}
