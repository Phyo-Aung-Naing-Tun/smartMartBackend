<?php

namespace App\Services\FailToBan;

use App\Contracts\FailToBan\FailToBanServiceInterface;
use App\Models\FailToBan\FailToBan;
use Illuminate\Http\Request;

class FailToBanService implements FailToBanServiceInterface
{
    private $ip;
    private $action;
    private $path;
    private $payload;
    private $platform;
    private $method;
    private $origin;

    public function initialize(Request $request, $type)
    {
        $data = RequestParser::extract($request,$type);
        $this->ip = $data['ip'];
        $this->action = $data['action'];
        $this->path = $data['path'];
        $this->payload = $data['payload'];
        $this->platform = $data['platform'];
        $this->method = $data['method'];
        $this->origin = $data['origin'];
    }

    public function handleFailRequest($status)
    {
        $failToBan = $this->isIpExist();
        if($failToBan){
            if($this->isIpShouldReset($failToBan)){
                $failToBan->delete();
                $this->createFailtoBan($status);
            }else if($this->isIpShouldBan($failToBan,$this->action)){
                $this->bannIP($failToBan,$this->action);

            }else{
                $this->updateFailtoBan($failToBan);
            }

        }else{
            $this->createFailtoBan($status);
        }
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
            'attempt_at' => now(),
            'platform' => $this->platform,
            'method' => $this->method,
            'origin' => $this->origin
        ]);
    }

    public function updateFailtoBan(FailToBan $failToBan)
    {
        $failToBan->attempt_count++;
        $failToBan->attempt_at = now();
        $failToBan->save(); 
    }

    public function bannIP(FailToBan $failToBan,$type)
    {
        $bannDuration = now()->addMonth(config('failToBan.'. $type . '.bann_months'));
        $failToBan->attempt_at = now();
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