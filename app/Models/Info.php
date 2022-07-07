<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $fillable = [
        'wattage',
        'control',
        'size',
        'utilities',
        'trademark',
        'produce',
        'product_id',
    ];
    
}
