<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestockProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['restock_id'];

    protected $primaryKey = 'restock_id';

    public function product_name(){
        return $this->belongsTo(Products::class,'product_id','product_id');
    }
}
