<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receivable extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'receivables';

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
}
