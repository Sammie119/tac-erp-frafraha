<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\VWProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['projects'] = VWProject::orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['projects'] = VWProject::where('division', get_logged_user_division_id())->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('projects.projects', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'due_date' => ['required', 'date', 'after:yesterday'],
        ]);
//        dd($request->all());

        Project::firstOrCreate([
            'name' => $request['name'],
             'due_date' => $request['due_date'],
        ],[
            'description' => $request['description'],
            'division' => get_logged_user_division_id(),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('projects', absolute: false))->with('success', 'Project Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'due_date' => ['required', 'date'],
        ]);
//        dd($request->all());

        Project::find($request['id'])->update([
            'name' => $request['name'],
            'due_date' => $request['due_date'],
            'description' => $request['description'],
            'status' => $request['status'],
            'division' => get_logged_user_division_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('projects', absolute: false))->with('success', 'Project Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
//         dd($request->id);
        Project::find($request->id)->delete();

        return redirect(route('projects', absolute: false))->with('success', 'Project Deleted Successfully!!!');
    }
}
