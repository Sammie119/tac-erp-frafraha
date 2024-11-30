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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){

            $model->sku = 'TAC-'.date('Y')."-".strtotime(now());

            return $model;
        });

        static::updating(function ($model){

            if(empty($model->sku) || $model->sku == null){
                $model->sku = 'TAC-'.date('Y')."-".strtotime(now());
            }

            return $model;
        });
    }

    public function division_name(){
        return $this->belongsTo(SystemLOV::class,'division','id');
    }

    public function type_name(){
        return $this->belongsTo(SystemLOV::class,'type','id');
    }
}
