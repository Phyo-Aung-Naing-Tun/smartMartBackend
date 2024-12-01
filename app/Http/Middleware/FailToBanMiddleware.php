<?php

namespace App\Http\Middleware;

use App\Services\FailToBan\FailToBanService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FailToBanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$type): Response
    {
        $failToBan = new FailToBanService($request,$type);
        $failToBan->log();
        return $next($request);
    }
}