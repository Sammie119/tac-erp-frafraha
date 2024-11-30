<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use App\Models\Products;
use App\Models\ProductSubCategory;
use App\Models\RestockProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        where('division', get_logged_user_division_id())
        if(get_logged_in_user_id() === 1){
            $data['products'] = Products::where('is_material', 0)->orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['products'] = Products::where(['is_material' => 0,'division' => get_logged_user_division_id()])->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('product.products', $data);
    }

    public function indexMaterial()
    {
        if(get_logged_in_user_id() === 1){
            $data['products'] = Products::where('is_material', 1)->orderByDesc('created_at')->get();//paginate(30);
        } else {
            $data['products'] = Products::where(['is_material' => 1,'division' => get_logged_user_division_id()])->orderByDesc('created_at')->get();//paginate(30);
        }
        return view('product.materials', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
//         dd($request->all());
        $request->validate([
            'type' => ['required', 'integer'],
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'file', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->has('sub_category')){
            $category_id = ProductSubCategory::find($request['sub_category'])->category_id;
        }
//dd($request->file('image'));
        if($request->file('image') != null){

//            $file = 'storage/'.$setup->text_logo;
//            if (File::exists(public_path($file))) {
//                File::delete($file);
//            }
//            dd($request->image);
            $destinationPath = 'storage/uploads/products';
            $file = 'tac'.date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $file);

            $request['image_url'] = 'uploads/products/'.$file;

        }

        Products::firstOrCreate([
            'name' => $request['name'],
            'division' => get_logged_user_division_id()
        ],[
            'category' => isset($request['sub_category']) ? $category_id : null,
            'sub_category' => isset($request['sub_category']) ? $request['sub_category'] : null,
            'reorder_level' => isset($request['reorder_level']) ? $request['reorder_level'] : null,
            'image_url' => isset($request['image_url']) ? $request['image_url'] : null,
            'description' => $request['description'],
            'type' => $request['type'],
            'is_material' => isset($request['is_material']) ? $request['is_material'] : 0,
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        if(isset($request['is_material']))
            return redirect(route('materials', absolute: false))->with('success', 'Material Created Successfully!!!');
        else
            return redirect(route('products', absolute: false))->with('success', 'Product Created Successfully!!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (Request $request)
    {
//        dd($request->all());
        $request->validate([
            'type' => ['required', 'integer'],
            'name' => ['required'],
            'description' => ['required'],
        ]);

        if($request->has('sub_category')){
            $category_id = ProductSubCategory::find($request['sub_category'])->category_id;
        }

        $product = Products::find($request->id);

        if($request->file('image') != null){

            $file = 'storage/'.$product->image_url;
            if (File::exists(public_path($file))) {
                File::delete($file);
            }
//            dd($request->image);
            $destinationPath = 'storage/uploads/products';
            $file = 'tac'.date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $file);

            $request['image_url'] = 'uploads/products/'.$file;

        }

        $product->update([
            'name' => $request['name'],
            'division' => get_logged_user_division_id(),
            'description' => $request['description'],
            'type' => $request['type'],
            'category' => isset($request['sub_category']) ? $category_id : null,
            'sub_category' => isset($request['sub_category']) ? $request['sub_category'] : null,
            'reorder_level' => isset($request['reorder_level']) ? $request['reorder_level'] : null,
            'image_url' => isset($request['image_url']) ? $request['image_url'] : null,
            'is_material' => isset($request['is_material']) ? $request['is_material'] : 0,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        if(isset($request['is_material']))
            return redirect(route('materials', absolute: false))->with('success', 'Material Updated Successfully!!!');
        else
            return redirect(route('products', absolute: false))->with('success', 'Product Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
//         dd($request->id);
        Products::find($request->id)->delete();

        if(Session::get('material') === 'materials')
            return redirect(route('materials', absolute: false))->with('success', 'Material Deleted Successfully!!!');
        else
            return redirect(route('products', absolute: false))->with('success', 'Product Deleted Successfully!!!');
    }

    public function restockProductIndex()
    {
        if(get_logged_in_user_id() === 1){
            $data['products'] = RestockProduct::orderByDesc('restock_id')->get();//paginate(30); //add division where clause
        } else {
            $data['products'] = RestockProduct::where('division', get_logged_user_division_id())->orderByDesc('restock_id')->get();//paginate(30); //add division where clause
        }
        return view('product.restock_products', $data);
    }

    public function restockProductStore (Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'product_id.*' => ['required', 'integer'],
            'quantity.*' => ['required', 'numeric', 'min:1'],
        ]);
//        dd($request->all());
        foreach ($request->product_id as $i => $product) {

            $prod = Products::find($product);

            RestockProduct::create([
                'product_id' => $product,
                'old_quantity' => $prod->stock_in,
                'old_sold' => $prod->stock_out,
                'old_stock' => $request->stock[$i],
                'new_quantity' => $request->quantity[$i],
                'division' => get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);

            $prod->update([
                'stock_in' => $prod->stock_in + $request->quantity[$i],
                'stock_out' => 0,
                'updated_by_id' => get_logged_in_user_id(),
            ]);

        }

        return redirect(route('restock_products', absolute: false))->with('success', 'Product Restocked Successfully!!');
    }

    public function restockProductUpdate (Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

//        dd($request->all());
        $product = RestockProduct::find($request->id);

        $prod = Products::find($product->product_id);

        if($prod->stock_in !== ($product->old_quantity + $product->new_quantity)){
            return redirect('restock_products')->with('error', 'Product Restock Update Unsuccessfully!! - There is a change in Product Stock');
        }

        $prod->update([
            'stock_in' => $product->old_stock + $request->quantity,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        $product->update([
            'new_quantity' => $request->quantity,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('restock_products', absolute: false))->with('success', 'Product Restock Update Successfully!!');
    }

    public function restockProductDestroy (Request $request)
    {
        $product = RestockProduct::find($request->id);
//dd($request->all());
        $prod = Products::find($product->product_id);

        if($prod->stock_in !== ($product->old_quantity + $product->new_quantity)){
            return redirect('restock_products')->with('error', 'Product Restock Update Unsuccessfully!! - There is a change in Product Stock');
        }

        $prod->update([
            'stock_in' => $product->old_stock - $request->quantity,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        $product->delete();

        return redirect(route('restock_products', absolute: false))->with('success', 'Product Restock Delete Successfully!!');
    }

    public function productPricingIndex (Request $request)
    {
        if(get_logged_in_user_id() === 1){
            $data['prices'] = ProductPrice::orderByDesc('price_id')->get();//paginate(30); //add division where clause
        } else {
            $data['prices'] = ProductPrice::where('division', get_logged_user_division_id())->orderByDesc('price_id')->get();//paginate(30); //add division where clause
        }
        return view('product.price_products', $data);
    }

    public function productPricingStore (Request $request)
    {
        $request->validate([
            'product_id' => ['required',],
            'new_cost' => ['required'],
            'new_price' => ['required'],
            'product_id.*' => ['required', 'integer'],
            'new_cost.*' => ['required', 'numeric', 'min:0'],
            'new_price.*' => ['required', 'numeric', 'min:0'],
        ]);
//        dd($request->all());
        foreach ($request->product_id as $i => $product) {

            $prod = Products::find($product);

            ProductPrice::create([
                'product_id' => $product,
                'old_cost' => $prod->cost,
                'old_price' => $prod->price,
                'new_cost' => $request->new_cost[$i],
                'new_price' => $request->new_price[$i],
                'division' => get_logged_user_division_id(),
                'created_by_id' => get_logged_in_user_id(),
                'updated_by_id' => get_logged_in_user_id(),
            ]);

            $prod->update([
                'cost' => $request->new_cost[$i],
                'price' => $request->new_price[$i],
                'updated_by_id' => get_logged_in_user_id(),
            ]);

        }

        return redirect(route('product_pricing', absolute: false))->with('success', 'Product Prices Changed Successfully!!');
    }

    public function productPricingUpdate (Request $request)
    {
        $product = ProductPrice::find($request->id);

        $prod = Products::find($product->product_id);

        $product->update([
            'new_cost' => $request->new_cost,
            'new_price' => $request->new_price,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        $prod->update([
            'cost' => $request->new_cost,
            'price' => $request->new_price,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        return redirect(route('product_pricing', absolute: false))->with('success', 'Product Price Update Successfully!!');
    }

    public function productPricingDestroy (Request $request)
    {
        $product = ProductPrice::find($request->id);

        $prod = Products::find($product->product_id);

        $prod->update([
            'cost' => $product->old_cost,
            'price' => $product->old_price,
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        $product->delete();

        return redirect(route('product_pricing', absolute: false))->with('success', 'Product Price Deleted Successfully!!');
    }

}
