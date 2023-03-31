<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Constant\CacheKey;
use App\Logic\User\Repository\UserRepository;
use Closure;
use Illuminate\Support\Facades\Redis;
use RedisException;

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

    public function serviceCreate(array $requestParams): array
    {
        if ((new UserRepository())->repositoryCreate($requestParams)) {
            return ["msg" => "创建成功"];
        }
        return [];
    }

    /**
     * @throws RedisException
     */
    public function serviceUpdate(array $requestParams): array
    {
        $uid        = $this->getUserUid();
        $updateUser = (new UserRepository())->repositoryUpdate([
            ["uid", "=", $uid]
        ], [
            "nickname" => $requestParams["nickname"],
            "mobile" => $requestParams["mobile"] ?? "",
            "email" => $requestParams["email"] ?? "",
            "avatar_url" => $requestParams["avatar_url"],
            "gender" => $requestParams["gender"],
            "birthday" => $requestParams["birthday"],
            "remark" => $requestParams["remark"],
            "profession" => $requestParams["profession"],
            "name" => $requestParams["name"],
        ]);
        if ($updateUser) {
            $redis      = Redis::connection()->client();
            $score      = $redis->get(CacheKey::$scoreKey . $uid);
            $userInfo   = [
                "uid" => $uid,
                "nickname" => $requestParams["nickname"],
                "mobile" => $requestParams["mobile"] ?? "",
                "email" => $requestParams["email"] ?? "",
                "avatar_url" => $requestParams["avatar_url"],
                "gender" => $requestParams["gender"],
                "birthday" => $requestParams["birthday"],
                "remark" => $requestParams["remark"],
                "profession" => $requestParams["profession"],
                "name" => $requestParams["name"],
                "score" => $score + 20,
            ];
            $loginToken = $this->updateUserInfo($userInfo);
            $redis->incrByFloat(CacheKey::$scoreKey . $uid, 20);
            (new UserRepository())->repositoryUpdate([
                ["uid", "=", $this->getUserUid()]
            ], ["score" => $score + 20]);
            return ["row" => 1, "token" => $loginToken, "user" => $userInfo];
        }
        return ["row" => 0];
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
