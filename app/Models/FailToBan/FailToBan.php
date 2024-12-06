<?php

namespace App\Models\FailToBan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailToBan extends Model
{
    use HasFactory;

    public $fillable = [
        'ip',
        'action',
        'payload',
        'path',
        'status',
        'attempt_count',
        'attempt_at',
        'bann_untail',
        'platform',
        'method',
        'origin'
    ];

    public function failToBanLogs()
    {
        return $this->hasMany(FailToBanLog::class);
    }

    public function scopeIsIpExist($query,$ip)
    {
        return $query->when('ip',function($q)use($ip){
            $q->where('ip',$ip);
        });
    }

    public function scopeIsIpBan($query,$ip)
    {
        return $query->when('ip',function($q)use($ip){
            $q->where('ip',$ip)->where('bann_untail' , '>' , now());
        });
    }
}