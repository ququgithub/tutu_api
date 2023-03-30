<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidate;
use App\Library\Response;
use App\Logic\User\Service\LoginService;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use Illuminate\Http\JsonResponse;
use RedisException;

class LoginController extends Controller
{
    /**
     * @throws InvalidConfigException
     * @throws RedisException
     */
    public function login(LoginValidate $loginValidate): JsonResponse
    {
        $loginInfo = (new LoginService())->serviceLogin($loginValidate->post("code"));
        if (!isset($loginInfo["msg"])) {
            return Response::success($loginInfo);
        }
        return Response::error($loginInfo);
    }
}
