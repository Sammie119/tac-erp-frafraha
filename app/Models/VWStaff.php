<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VWStaff extends Model
{
    use HasFactory;

    protected $table = 'public.vw_staff';
    protected $primaryKey = 'staff_id';
}
