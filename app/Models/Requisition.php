<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['req_id'];

    protected $primaryKey = 'req_id';


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }


    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id', 'id');
    }
}
