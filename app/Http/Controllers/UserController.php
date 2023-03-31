<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserInfoValidate;
use App\Library\Response;
use App\Logic\User\Service\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function info(): JsonResponse
    {
        return Response::success((new UserService())->serviceUserInfo());
    }

    public function update(UpdateUserInfoValidate $validate): JsonResponse
    {
        $updateUserInfo = (new UserService())->serviceUpdate($validate->all());
        if ($updateUserInfo["row"] > 0) {
            return Response::success($updateUserInfo);
        }
        return Response::error();
    }
}
