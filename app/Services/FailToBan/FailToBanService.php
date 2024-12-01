<?php

namespace App\Services\FailToBan;

use App\Models\FailToBan\FailToBan;
use Illuminate\Http\Request;

class FailToBanService extends FailToBan
{
    private $ip;
    private $action;
    private $path;
    private $payload;
    private $platform;
    private $method;
    private $origin;

    public function __construct(Request $request, $type)
    {
        $this->ip =  $request->header('X-CLIENT-IP');
        $this->action = $type;
        $this->path = $request->server('REQUEST_URI');
        $this->payload = json_encode($request->getContent());
        $this->platform = $request->server('HTTP_SEC_CH_UA_PLATFORM');
        $this->method = $request->server('REQUEST_METHOD');
        $this->origin = $request->server('HTTP_ORIGIN');
    }

    public function log()
    {
        
        dd(['ip' => $this->ip, 'action' => $this->action, 'path' => $this->path, 'payload' => json_decode($this->payload), 'platform' => $this->platform, 'method' => $this->method, 'origin' => $this->origin]);
    }

    public function create($status)
    {
        $this->create([
            'ip' => $this->ip,
            'action' => $this->action,
            'payload' => $this->payload,
            'path' => $this->path,
            'status' => $status,
            'attempt_count' => 1,
            'attempt_at' => json_encode([ '1' => now()]),
            'platform' => $this->platform,
            'method' => $this->method,
            'origin' => $this->origin
        ]);
    }
}