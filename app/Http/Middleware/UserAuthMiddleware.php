<?php

namespace App\Http\Middleware;

use App\Library\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use RedisException;

class UserAuthMiddleware
{
    /**
     * @throws RedisException
     */
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header("Authorization", "");
        if (empty($authorization)) {
            return Response::error([], 101, "请登录", 401);
        }
        $authorization = trim(str_replace("Bearer", "", $authorization));
        $userCacheInfo = Redis::connection()->client()->get($authorization);
        if (empty($userCacheInfo)) {
            return Response::error([], 101, "请登录", 401);
        }
        return $next($request);
    }
}
