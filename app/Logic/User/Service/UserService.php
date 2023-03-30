<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Logic\User\Repository\UserRepository;
use Closure;

class UserService extends BaseService implements UserServiceInterface
{

    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {
            extract($requestParams);
            if (!empty($openid)) {
                $query->where("openid", "=", $openid);
            }
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return [];
    }

    public function serviceCreate(array $requestParams): bool
    {
        return (new UserRepository())->repositoryCreate($requestParams);
    }

    public function serviceUpdate(array $requestParams): int
    {
        return 0;
    }

    public function serviceDelete(array $requestParams): int
    {
        return 0;
    }

    public function serviceFindByOpenId(array $requestParams): array
    {
        return (new UserRepository())->repositoryFind(self::searchWhere($requestParams), ["uid", "nickname", "avatar_url"]);
    }

    public function serviceUserInfo(): array
    {
        return (new UserRepository())->repositoryFind(function ($query) {
            $query->where("uid", "=", $this->getUserUid());
        }, [
            "uid",
            "nickname",
            "mobile",
            "email",
            "avatar_url",
            "gender",
            "age",
            "birthday",
            "remark",
            "profession",
            "score",
            "invite_count",
            "production_count",
            "name",
        ]);
    }

    public function serviceFind(array $requestParams): array
    {
        return (new UserRepository())->repositoryFind(self::searchWhere($requestParams), [
            "uid",
            "openid",
            "nickname",
            "mobile",
            "email",
            "avatar_url",
            "gender",
            "age",
            "birthday",
            "remark",
            "profession",
            "score",
            "invite_count",
            "production_count",
            "name",
        ]);
    }
}
