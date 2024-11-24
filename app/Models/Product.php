<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'image',
        'price'
    ];


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class)->withPivot('promotion_id');
    }
}