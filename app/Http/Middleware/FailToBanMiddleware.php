<?php

namespace App\Http\Middleware;

use App\Http\Responses\BaseResponse;
use App\Models\FailToBan\FailToBan;
use App\Services\FailToBan\FailToBanService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FailToBanMiddleware extends FailToBanService
{

    private $baseResponse;
    public function __construct(BaseResponse $baseResponse)
    {
        $this->baseResponse = $baseResponse;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$type): Response
    {
        $failToBanService = new FailToBanService($request,$type);

        if($failToBanService->isIpBan())
        {
            return $this->baseResponse->error("Your account is ban for " . config('failToBan.'.$type.'.bann_months') . ' months',403);
        }

        $response = $next($request);
        $status = $response->getStatusCode();

        if($status > 400 || $status < 200){
            $failToBan = $failToBanService->isIpExist();
            if($failToBan){
                if($failToBanService->isIpShouldReset($failToBan)){
                    $failToBan->delete();
                    $failToBanService->createFailtoBan($status);
                }else if($failToBanService->isIpShouldBan($failToBan,$type)){
                    $failToBanService->bannIP($failToBan,$type);

                }else{
                    $failToBanService->updateFailtoBan($failToBan);
                }

            }else{
                $failToBanService->createFailtoBan($status);
            }

        }
        return $response;
        
    }
}