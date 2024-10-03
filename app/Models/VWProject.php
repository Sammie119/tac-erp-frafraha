<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VWProject extends Model
{
    use HasFactory;

    protected $table = 'public.vw_project';

    protected $primaryKey = 'project_id';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
