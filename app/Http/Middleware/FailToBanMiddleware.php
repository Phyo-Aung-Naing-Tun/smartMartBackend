<?php

namespace App\Http\Middleware;

use App\Http\Responses\BaseResponse;
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
        $this->failToBanInit($request,$type);

        if($this->isIpBan())
        {
            return $this->baseResponse->error("Your account is ban for . config()");
        }

        $response = $next($request);
        $status = $response->getStatusCode();

        if($status > 400){
            $failToBan = $this->isIpExist();
            if($failToBan){
                if($this->isIpShouldBan($failToBan)){
                    return 'ban';
                }else{
                $this->updateFailtoBan($failToBan);
                }
            }else{
                $this->createFailtoBan($status);
            }

        }
        return $response;
        
    }
}