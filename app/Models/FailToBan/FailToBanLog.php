<?php

namespace App\Models\FailToBan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailToBanLog extends Model
{
    use HasFactory;
    public $timestamps = true;
    const UPDATED_AT = null;

    public $fillable=[
        'ip',
        'action',
        'payload',
        'path',
        'status',
        'attempt_at',
        'platform',
        'method',
        'origin'
    ];
}