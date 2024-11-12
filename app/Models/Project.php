<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['project_id'];

    protected $primaryKey = 'project_id';

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'project_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'supplier_id', 'supplier_id');
    }
}
