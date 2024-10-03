<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['product_id'];

    protected $primaryKey = 'product_id';

    public function division_name(){
        return $this->belongsTo(SystemLOV::class,'division','id');
    }

    public function type_name(){
        return $this->belongsTo(SystemLOV::class,'type','id');
    }
}
