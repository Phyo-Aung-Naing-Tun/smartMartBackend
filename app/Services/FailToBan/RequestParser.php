<?php
namespace App\Services\FailToBan;

use Illuminate\Http\Request;

class RequestParser
{
    public static function extract(Request $request,$type) : array {
        return [
        "ip" =>  $request->header('X-CLIENT-IP') ?? '12345',
        "action" => $type,
        "path" => $request->server('REQUEST_URI'),
        "payload" => json_encode($request->all()),
        "platform" => $request->server('HTTP_SEC_CH_UA_PLATFORM'),
        "method" => $request->server('REQUEST_METHOD'),
        "origin" => $request->server('HTTP_ORIGIN'),
        "meta" => [
            'url' => $request->fullUrl(),
            'request' => [
                'attributes' => $request->attributes->all(),
                'request' => $request->request->all(),
                'query' => $request->query->all(),
                'server' => $request->server->all(),
                'files' => $request->files->all(),
                'cookies' => $request->cookies->all(),
                'headers' => $request->headers->all(),
            ],
        ]
        
        ];
    }
}