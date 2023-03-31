<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Library\UserJwt;
use function request;

class BaseService
{
    protected function getUserUid(): int
    {
        $authorization = request()->header("Authorization");
        $authorization = trim(str_replace("Bearer", "", $authorization));
        return UserJwt::decodeJwt($authorization)["uid"];
    }

    protected function getUserInfo(): array
    {
        $authorization = request()->header("Authorization");
        $authorization = trim(str_replace("Bearer", "", $authorization));
        return UserJwt::decodeJwt($authorization);
    }

    protected function updateUserInfo(array $userInfo): string
    {
        return UserJwt::encodeJwt($userInfo);
    }
}
