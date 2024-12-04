<?php
namespace App\Contracts\FailToBan;

use App\Models\FailToBan\FailToBan;
use Illuminate\Http\Request;

interface FailToBanServiceInterface
{
    public function initialize(Request $request,$type);
    public function createFailtoBan($status);
    public function updateFailtoBan(FailToBan  $failToBan);
    public function bannIP(FailToBan $failToBan,$type);
    public function isIpExist();
    public function isIpBan();
    public function isIpShouldBan(FailToBan $failToBan,$type);
    public function isIpShouldReset(FailToBan $failToBan,$type);
    public function handleFailRequest($status,$type);

    
    
    
}