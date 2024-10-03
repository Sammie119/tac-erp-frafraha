<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function transaction(){
        return $this->belongsTo(VWTransactions::class,'transaction_id','transaction_id');
    }
}
