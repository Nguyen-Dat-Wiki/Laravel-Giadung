<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'quantity',
        'condition',
        'time_start',
        'time_end',
        'active',
        'Payment',
        'number',
        'number_active',
        'limitprice',
    ];
}
