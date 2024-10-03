<?php

namespace App\Http\Controllers;

use App\Models\SystemLOV;
use Illuminate\Http\Request;
use App\Models\SystemLOVCategories;

class DropdownsController extends Controller
{
    public function index()
    {
        $data['dropdowns'] = SystemLOVCategories::orderBy('category_name')->get();//paginate(30);
        return view('system_admin.dropdowns', $data);
    }

    public function store (Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        SystemLOVCategories::firstOrCreate([
            'category_name' => $request->name
            ],[
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('system_lovs', absolute: false))->with('success', 'LOV Category Created Successfully!!!');
    }

    public function update (Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        SystemLOVCategories::find($request->id)->update([
            'category_name' => $request->name,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('system_lovs', absolute: false))->with('success', 'LOV Category Update Successfully!!!');
    }

    public function createListOfValue(Request $request)
    {

        if(empty($request->value)){
            return redirect(route('system_lovs', absolute: false))->with('error', 'List of Values is Empty!!!');
        }
        // dd($request->all());
        foreach ($request->value as $key => $value) {
            if(empty($request->value_id[$key])){
                SystemLOV::updateOrCreate([
                    'category_id' => $request->id,
                    'name' => $value,

                ],
                [
                    'created_by_id' => get_logged_in_user_id(),
                    'updated_by_id' =>  get_logged_in_user_id(),
                ]);
            } else {
                SystemLOV::find($request->value_id[$key])->update([
                    'category_id' => $request->id,
                    'name' => $value,
                    'updated_by_id' =>  get_logged_in_user_id(),
                ]);
            }
        }

        return redirect(route('system_lovs', absolute: false))->with('success', 'List of Values is Saved Successfully!!!');

    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        SystemLOVCategories::find($request->id)->delete();

        return redirect(route('system_lovs', absolute: false))->with('success', 'LOV Category deleted Successfully!!!');
    }

    public function deleteLOVValue (Request $request)
    {
        // dd($request->all());
        SystemLOV::find($request->id)->delete();

        return redirect(route('system_lovs', absolute: false))->with('success', 'LOV Value deleted Successfully!!!');
    }
}