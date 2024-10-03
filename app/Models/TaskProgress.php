<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'progress_id';

    protected $guarded = ['progress_id'];
}
