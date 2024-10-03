<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskProgress;
use App\Models\VWProject;
use App\Models\VWStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['tasks'] = Task::orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['tasks'] = Task::where('division', get_logged_user_division_id())->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('tasks.tasks', $data);
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
            'project' => ['required'],
            'assigned_staff' => ['required']
        ]);

        $request['project_id'] = Project::where('name', $request['project'])->first()->project_id;
        $request['assigned_staff_id'] = VWStaff::where('full_name', $request['assigned_staff'])->first()->staff_id;

        Task::firstOrCreate([
            'name' => $request['name'],
            'due_date' => $request['due_date'],
        ],[
            'description' => $request['description'],
            'priority' => $request['priority'],
            'project_id' => $request['project_id'],
            'assigned_staff_id' => $request['assigned_staff_id'],
            'division' => get_logged_user_division_id(),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('tasks', absolute: false))->with('success', 'Task Created Successfully!!!');
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
            'due_date' => ['required', 'date', 'after:yesterday'],
            'project' => ['required'],
            'assigned_staff' => ['required']
        ]);

        $request['project_id'] = Project::where('name', $request['project'])->first()->project_id;
        $request['assigned_staff_id'] = VWStaff::where('full_name', $request['assigned_staff'])->first()->staff_id;

        Task::find($request['id'])->update([
            'name' => $request['name'],
            'due_date' => $request['due_date'],
            'description' => $request['description'],
            'priority' => $request['priority'],
            'project_id' => $request['project_id'],
            'assigned_staff_id' => $request['assigned_staff_id'],
            'division' => get_logged_user_division_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('tasks', absolute: false))->with('success', 'Task Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
//         dd($request->id);
        Task::find($request->id)->delete();

        return redirect(route('tasks', absolute: false))->with('success', 'Task Deleted Successfully!!!');
    }

    public function myTasks(Request $request)
    {
        if(get_logged_in_user_id() === 1){
            $data['projects'] = VWProject::where('status', '!=', 2)->orderByDesc('created_at')->get();//paginate(30);
            $data['completed'] = VWProject::where('status', 2)->orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['projects'] = VWProject::whereRaw("status != 2 AND division = ".get_logged_user_division_id()." AND ".Auth::user()->staff_id." = ANY(assigned_staff_arr)")->orderByDesc('created_at')->get();//paginate(30);
            $data['completed'] = VWProject::whereRaw("status = 2 AND division = ".get_logged_user_division_id()." AND ".Auth::user()->staff_id." = ANY(assigned_staff_arr)")->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('tasks.my_tasks', $data);
    }

    public function taskProgressStore(Request $request)
    {
        $request->validate([
            'task_id' => ['required'],
            'pending' => ['required'],
            'in_progress' => ['required'],
//            'remarks' => ['nullable', 'required_if:completed.*,in:1']
        ]);
        foreach ($request['task_id'] as $i => $task_id) {

            if(isset($request['in_progress'][$i])){
                TaskProgress::updateOrCreate(
                    [
                        'task_id' => $task_id,
                        'in_progress' => $request['in_progress'][$i],
                    ],
                    [
                        'completed' => 0,
                        'remarks' => $request['remarks'][$i],
                        'created_by_id' => get_logged_in_user_id(),
                        'updated_by_id' => get_logged_in_user_id(),
                    ]
                );

                Task::find($task_id)->update([
                    'status' => 1,
                ]);

                Project::find($request->id)->update([
                    'status' => 1,
                ]);
            }

            if(isset($request['completed'][$i])){
                TaskProgress::where('task_id', $task_id)->first()->update(
                    [
                        'completed' => $request['completed'][$i],
                        'remarks' => $request['remarks'][$i],
                        'updated_by_id' => get_logged_in_user_id(),
                    ]
                );

                Task::find($task_id)->update([
                    'status' => 2,
                ]);
            }

        }

        return redirect(route('my_tasks', absolute: false))->with('success', 'Task Process Successfully!!!');
//        dd($request->all());
    }
}
