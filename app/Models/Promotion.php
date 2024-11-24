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

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('product_id');
    }
}