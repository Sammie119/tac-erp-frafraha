<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setups extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function division_name(){
        return $this->belongsTo(SystemLOV::class,'division','id');
    }
}
