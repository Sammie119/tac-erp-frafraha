<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoresTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model){

            $product = Products::find($model->product_id);

//            if($product->type === 20) {
            if ($product->stock_in > 0){
                $product->update([
                    'stock_in' => $product->stock_in - $model->quantity,
                    'stock_out' => $product->stock_out + $model->quantity
                ]);
            }
//            }

            return $model;
        });

        static::updated(function ($model){

//            dd($model);

            return $model;
        });
    }


}
