<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VWTransactions extends Model
{
    use HasFactory;

    protected $table = 'public.vw_transactions';
    protected $primaryKey = 'transaction_id';
}
