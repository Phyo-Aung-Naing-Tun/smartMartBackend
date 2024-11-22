<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "seller_id",
        "email",
        "phone",
        "about",
        "address",
        "profile",
        "slogan",
        "type",
        "schedule"

    ];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }
}