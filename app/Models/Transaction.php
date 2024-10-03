<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['transaction_id'];

    protected $primaryKey = 'transaction_id';

    public function customer_name(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
