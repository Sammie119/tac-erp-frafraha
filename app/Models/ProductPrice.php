<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['price_id'];

    protected $primaryKey = 'price_id';

    public function product_name(){
        return $this->belongsTo(Products::class,'product_id','product_id');
    }
}
