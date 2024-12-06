<?php

namespace App\Services\FailToBan;

use App\Contracts\FailToBan\FailToBanLogServiceInterface;
use App\Models\FailToBan\FailToBanLog;
use Illuminate\Http\Request;

class FailToBanLogService implements FailToBanLogServiceInterface
{
    public function makeLog(Request $request, $type = null, $status = null)
    {
        $data = RequestParser::extract($request,$type);
        FailToBanLog::create([
            "ip" => $data['ip'],
            "action" => $data['action'],
            "payload" => $data['payload'],
            "path" => $data['path'],
            "status" => '',
            "attempt_at" => now(),
            "platform" => $data['platform'],
            "method" => $data['method'],
            "origin" => $data['origin'],
        ]);
    }
}