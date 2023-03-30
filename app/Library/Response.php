<?php
declare(strict_types = 1);

namespace App\Library;

use Illuminate\Http\JsonResponse;

class Response
{
    public static function success(array $data = [], int $code = 100, string $msg = "请求成功", int $httpCode = 200): JsonResponse
    {
        return response()->json([
            "code" => $code,
            "data" => $data,
            "msg" => $msg
        ], $httpCode);
    }

    public static function error(array $data = [], int $code = 101, string $msg = "请求成功", int $httpCode = 200): JsonResponse
    {
        return response()->json([
            "code" => $code,
            "data" => $data,
            "msg" => $msg
        ], $httpCode);
    }
}
