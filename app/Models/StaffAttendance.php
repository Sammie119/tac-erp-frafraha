<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'attendance_id';

    protected $guarded = ['attendance_id'];

    protected $appends = ['division_name'];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }

    public function getDivisionNameAttribute()
    {
        return SystemLOV::find($this->attributes['division'])->name;
    }


    public function division_name()
    {
        return $this->belongsTo(SystemLOV::class, 'division', 'id');
    }
}
