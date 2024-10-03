<?php

namespace App\Http\Controllers;

use App\Models\Setups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SetupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['setups'] = Setups::all();
        } else {
            $data['setups'] = Setups::where('division', get_logged_user_division_id())->get();
        }
        return view('setups.setups', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone1' => ['required', 'numeric'],
            'text_logo' => ['required', 'file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
            'nhil' => ['required', 'numeric'],
            'gehl' => ['required', 'numeric'],
            'covid19' => ['required', 'numeric'],
            'vat' => ['required', 'numeric'],
            'division' => ['required', 'integer']
        ]);
//        dd($request->all());
        $destinationPath = 'storage/uploads/';
        $file = 'tac'.date('YmdHis') . "." . $request->text_logo->getClientOriginalExtension();
        $request->text_logo->move($destinationPath, $file);

        Setups::firstOrCreate([
            'display_name' => $request['display_name'],
            'phone1' => $request['phone1'],
            'division' => $request['division'],
        ],[
            'address' => $request['address'],
            'phone2' => $request['phone2'],
            'text_logo' => 'uploads/'.$file,
            'email' => $request['email'],
            'facebook' => $request['facebook'],
            'nhil' => $request['nhil'],
            'gehl' => $request['gehl'],
            'covid19' => $request['covid19'],
            'vat' => $request['vat']
        ]);

        return redirect(route('setups', absolute: false))->with('success', 'System Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone1' => ['required', 'numeric'],
            'text_logo' => ['nullable', 'file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
            'nhil' => ['required', 'numeric'],
            'gehl' => ['required', 'numeric'],
            'covid19' => ['required', 'numeric'],
            'vat' => ['required', 'numeric'],
            'division' => ['required', 'integer']
        ]);
//        dd($request->all());
        $setup = Setups::find($request['id']);

        if($request->file('text_logo') != null){

            $file = 'storage/'.$setup->text_logo;
            if (File::exists(public_path($file))) {
                File::delete($file);
            }

            $destinationPath = 'storage/uploads/';
            $file = 'tac'.date('YmdHis') . "." . $request->text_logo->getClientOriginalExtension();
            $request->text_logo->move($destinationPath, $file);

            $setup->update([
                'text_logo' => 'uploads/'.$file,
            ]);
        }

        $setup->update([
            'display_name' => $request['display_name'],
            'phone1' => $request['phone1'],
            'division' => $request['division'],
            'address' => $request['address'],
            'phone2' => $request['phone2'],
            'email' => $request['email'],
            'facebook' => $request['facebook'],
            'nhil' => $request['nhil'],
            'gehl' => $request['gehl'],
            'covid19' => $request['covid19'],
            'vat' => $request['vat']
        ]);

        return redirect(route('setups', absolute: false))->with('success', 'System Update Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setups $setups)
    {
        //
    }
}
