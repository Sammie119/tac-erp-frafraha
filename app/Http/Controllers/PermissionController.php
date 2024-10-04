<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['permissions'] = Permission::orderByDesc('created_at')->get();//paginate(30);;
        return view('system_admin.permissions', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);
        $permissions = explode(',', $request->name);
//        dd($permissions);
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => trim($permission)
            ]);
        }

        return redirect(route('permissions', absolute: false))->with('success', 'Permission Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        Permission::find($request->id)->update([
            'name' => $request->name
        ]);

        return redirect(route('permissions', absolute: false))->with('success', 'Permission Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request->id);
        Permission::find($request->id)->delete();

        return redirect(route('permissions', absolute: false))->with('success', 'Permission deleted Successfully!!!');
    }
}
