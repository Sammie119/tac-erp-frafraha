<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'financial_transactions';

    protected $primaryKey = 'financial_id';

    protected $guarded = ['financial_id'];

    public function division_name(){
        return $this->belongsTo(SystemLOV::class,'division','id');
    }

    public function type_name(){
        return $this->belongsTo(SystemLOV::class,'type','id');
    }

    public function mode_name(){
        return $this->belongsTo(SystemLOV::class,'mode','id');
    }

    public function source_name(){
        return $this->belongsTo(SystemLOV::class,'source','id');
    }

    public function created_by(){
        return $this->belongsTo(User::class,'updated_by_id','id');
    }
}
