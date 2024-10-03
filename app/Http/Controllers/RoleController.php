<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roles'] = Role::orderBy('name')->get();//paginate(30);
        return view('system_admin.roles', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        Role::firstOrCreate([
            'name' => $request->name
        ]);

        return redirect(route('roles', absolute: false))->with('success', 'Role Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        Role::find($request->id)->update([
            'name' => $request->name
        ]);

        return redirect(route('roles', absolute: false))->with('success', 'Role Updated Successfully!!!');
    }

    public function storePermission(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'permissions' => 'required'
        ]);

        $role = Role::find($request->id);
        $role->syncPermissions($request->permissions);

        return redirect(route('roles', absolute: false))->with('success', 'Permissions Added Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request->id);
        Role::find($request->id)->delete();

        return redirect(route('roles', absolute: false))->with('success', 'Role deleted Successfully!!!');
    }
}
