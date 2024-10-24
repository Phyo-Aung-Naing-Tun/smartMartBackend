<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class BaseResponse
{
    public function success($data, $message = 'Operation Successful', $status = 200): JsonResponse
    {

        return response()->json(['data' => $data, 'message' => $message], $status);
    }

    public function error($message = 'Operation Failed', $status = 500): JsonResponse
    {

        return response()->json(['message' => $message], $status);
    }
}
