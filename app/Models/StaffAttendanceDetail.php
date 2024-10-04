<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffAttendanceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff_attendances_details';

    protected $guarded = ['id'];

    protected $casts = [
        'checkin_time' => 'datetime:Y-m-d H:i:s',
        'departure_time' => 'datetime:Y-m-d H:i:s',
    ];

    protected $appends = ['staff'];

    public function getStaffAttribute()
    {
        return VWStaff::where('staff_number', $this->staff_number)->first()->full_name;

    }
}
