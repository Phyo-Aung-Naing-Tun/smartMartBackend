<?php

namespace App\Http\Middleware;

use App\Contracts\FailToBan\FailToBanLogServiceInterface;
use App\Contracts\FailToBan\FailToBanServiceInterface;
use App\Http\Responses\BaseResponse;
use App\Models\FailToBan\FailToBan;
use App\Services\FailToBan\FailToBanService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FailToBanMiddleware
{

    private $baseResponse;
    private $failToBanService;
    private $failToBanLogService;
    
    public function __construct(BaseResponse $baseResponse,FailToBanServiceInterface $failToBanService,FailToBanLogServiceInterface $failToBanLogService)
    {
        $this->baseResponse = $baseResponse;
        $this->failToBanService = $failToBanService;
        $this->failToBanLogService = $failToBanLogService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$type): Response
    {
        $this->failToBanService->initialize($request,$type);

        if($this->failToBanService->isIpBan())
        {
            return $this->baseResponse->error("You are banned for " . config('failToBan.'.$type.'.bann_months') . ' months',403);
        }

        $response = $next($request);
        $status = $response->getStatusCode();

        if($status > 400 || $status < 200){
          $failToBan =  $this->failToBanService->handleFailRequest($status);
          $this->failToBanLogService->makeLog($request,$type,$status,$failToBan);
        }
        return $response;
        
    }
}