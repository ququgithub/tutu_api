<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function info(): JsonResponse
    {
        return Response::success((new UserService())->serviceUserInfo());
    }
}
