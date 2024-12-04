<?php

namespace App\Services\FailToBan;

use App\Models\FailToBan\FailToBan;
use Illuminate\Http\Request;

class FailToBanService 
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
        $this->ip =  $request->header('X-CLIENT-IP') ?? '12345';
        $this->action = $type;
        $this->path = $request->server('REQUEST_URI');
        $this->payload = json_encode($request->all());
        $this->platform = $request->server('HTTP_SEC_CH_UA_PLATFORM');
        $this->method = $request->server('REQUEST_METHOD');
        $this->origin = $request->server('HTTP_ORIGIN');
    }

    public function log()
    {  
        dd(['ip' => $this->ip, 'action' => $this->action, 'path' => $this->path, 'payload' => json_decode($this->payload), 'platform' => $this->platform, 'method' => $this->method, 'origin' => $this->origin]);
    }

    public function createFailtoBan($status)
    {
        FailToBan::create([
            'ip' => $this->ip,
            'action' => $this->action,
            'payload' => json_encode($this->payload),
            'path' => $this->path,
            'status' => $status,
            'attempt_count' => 1,
            'attempt_at' => json_encode(now()),
            'platform' => $this->platform,
            'method' => $this->method,
            'origin' => $this->origin
        ]);
    }

    public function updateFailtoBan(FailToBan $failToBan)
    {
        $failToBan->attempt_count++;
        $failToBan->attempt_at = json_encode(now());
        $failToBan->save(); 
    }

    public function bannIP(FailToBan $failToBan,$type)
    {
        $bannDuration = now()->addMonth(config('failToBan.'. $type . '.bann_months'));
        $failToBan->attempt_at = json_encode(now());
        $failToBan->bann_untail = $bannDuration;
        $failToBan->save(); 

    }

    public function isIpExist()
    {
        $data = FailToBan::isIpExist($this->ip)->first();
        return $data;
    }


    public function isIpBan()
    {
        $data = FailToBan::isIpBan($this->ip)->exists();
        return $data;
    }

    public function isIpShouldBan(FailToBan $failToBan,$type = 'auth')
    {
        $minAttempth = config('failToBan.'. $type . '.min_attempt');
        $duration = $failToBan->created_at->addMinutes(config('failToBan.'. $type . '.duration_minutes'));
        if($duration > now() && $failToBan->attempt_count > $minAttempth){
            return true;
        }else{
            return false;
        }  
    }

    public function isIpShouldReset(FailToBan $failToBan,$type = 'auth')
    {
        $duration = $failToBan->created_at->addMinutes(config('failToBan.'. $type . '.duration_minutes'));
        if($duration < now()){
            return true;
        }else{
            return false;
        }

    }

}