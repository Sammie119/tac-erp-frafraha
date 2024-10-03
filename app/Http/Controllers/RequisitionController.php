<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Requisition;
use App\Models\RequisitionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['requisitions'] = Requisition::orderbyDesc('request_date')->get();//paginate(30);
        } else {
            $data['requisitions'] = Requisition::where('division', get_logged_user_division_id())->orderByDesc('request_date')->get();//paginate(30);
        }
        return view('product.requisitions', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd(request()->all());
        $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required'],
            'product_id.*' => ['required', 'integer'],
            'quantity.*' => ['required', 'numeric', 'min:1'],
        ]);

//        dd($request->all());
        $requisition = Requisition::create([
            'division' => get_logged_user_division_id(),
            'request_date' => date('Y-m-d'),
            'approved_by_id' => get_logged_in_user_id(),
//            'approved_date' => null,
            'status' => 0,
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        foreach ($request->product_id as $i => $product) {
//            $prod = Products::find($product);

            RequisitionDetails::create([
                'req_id' => $requisition->req_id,
                'product_id' => $product,
                'req_quantity' => $request['quantity'][$i],
                'issued_quantity' => 0,
//                'remarks' => null,
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('requisitions', absolute: false))->with('success', 'Requisition Created Successfully!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//                dd(request()->all());
        $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required'],
            'product_id.*' => ['required', 'integer'],
            'quantity.*' => ['required', 'numeric', 'min:1'],
        ]);

        Requisition::find($request['id'])->update([
            'division' => get_logged_user_division_id(),
            'request_date' => date('Y-m-d'),
            'approved_by_id' => get_logged_in_user_id(),
            'status' => 0,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        DB::table('requisition_details')->where('req_id', $request['id'])->delete();

        foreach ($request->product_id as $i => $product) {

            RequisitionDetails::create([
                'req_id' => $request['id'],
                'product_id' => $product,
                'req_quantity' => $request['quantity'][$i],
                'issued_quantity' => 0,
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);

        }

        return redirect(route('requisitions', absolute: false))->with('success', 'Requisition Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::table('requisition_details')->where('req_id', $request['id'])->delete();
        Requisition::find($request['id'])->delete();

        return redirect(route('requisitions', absolute: false))->with('success', 'Requisition Deleted Successfully!!');
    }

    public function approveRequisition(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'issued_quantity' => ['required'],
            'remarks' => ['required'],
            'remarks.*' => ['required', 'string'],
            'quantity.*' => ['required', 'numeric', 'min:1'],
        ]);

        Requisition::find($request['req_id'])->update([
            'approved_by_id' => get_logged_in_user_id(),
            'approved_date' => date('Y-m-d'),
            'status' => 2,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        foreach ($request->id as $i => $id) {
            $req = RequisitionDetails::find($id);
            $prod = Products::find($req->product_id);
            if($request['update']){
                if($prod->type == 20){
                    $prod->update([
                        'stock_in' => ($request['remarks'][$i] == 'Cancelled') ? ($prod->stock_in + $req->issued_quantity) : ($prod->stock_in + $req->issued_quantity) - $request['issued_quantity'][$i],
                        'updated_by_id' => get_logged_in_user_id(),
                    ]);
                }
            } else {
                if($prod->type == 20){
                    $prod->update([
                        'stock_in' => ($request['remarks'][$i] == 'Cancelled') ? $prod->stock_in : $prod->stock_in - $request['issued_quantity'][$i],
                        'updated_by_id' => get_logged_in_user_id(),
                    ]);
                }
            }

            $req->update([
                'issued_quantity' => ($request['remarks'][$i] == 'Cancelled') ? 0 : $request['issued_quantity'][$i],
                'remarks' => $request['remarks'][$i],
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('requisitions', absolute: false))->with('success', 'Requisition Approved Successfully!!');
    }
}
