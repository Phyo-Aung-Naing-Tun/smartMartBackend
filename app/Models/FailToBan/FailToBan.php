<?php

namespace App\Models\FailToBan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailToBan extends Model
{
    use HasFactory;

    public $fillable = [
        'ip',
        'identifier',
        'action',
        'payload',
        'path',
        'status',
        'attempt_count',
        'attempt_at',
        'bann_untail'

    ];
}