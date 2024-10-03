<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['task_id'];

    protected $primaryKey = 'task_id';

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(VWStaff::class, 'assigned_staff_id', 'staff_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

}
