<?php

namespace App\Http\Middleware;

use App\Library\Response;
use App\Library\UserJwt;
use Closure;
use Illuminate\Http\Request;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header("Authorization", "");
        if (empty($authorization)) {
            return Response::error([], 101, "请登录", 401);
        }
        $authorization = trim(str_replace("Bearer", "", $authorization));
        $userInfo      = UserJwt::decodeJwt($authorization);
        if (empty($userInfo)) {
            return Response::error([], 101, "请登录", 401);
        }

        return $next($request);
    }
}
