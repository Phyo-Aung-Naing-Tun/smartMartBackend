<?php

namespace App\Services\FailToBan;

use App\Models\FailToBan\FailToBan;
use Illuminate\Http\Request;

class FailToBanService extends FailToBan
{
    private $ip;
    private $identifier;
    private $action;
    private $path;
    private $payload;

    public function __construct(Request $request,$type)
    {
        return [
            'type' => $type,
            'request' => $request
        ];
    }
}