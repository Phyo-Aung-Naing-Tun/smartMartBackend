<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'shop_id',
        'type',
        'percentage',
        'discount_amount',
        'start_date',
        'end_date',
    ];
}