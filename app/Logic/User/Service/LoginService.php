<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Library\SnowFlakeId;
use App\Library\WeChatClient;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use Illuminate\Support\Facades\Redis;
use RedisException;

class LoginService
{
    /**
     * @throws InvalidConfigException
     * @throws RedisException
     */
    public function serviceLogin(string $code): array
    {
        $loginInfo = WeChatClient::client()->auth->session($code);
        if (isset($loginInfo["openid"])) {
            $userService = new UserService();
            $userInfo    = $userService->serviceFind(["openid" => $loginInfo["openid"]]);
            $uid         = $userInfo["uid"] ?? SnowFlakeId::getId();
            $nickname    = $userInfo["nickname"] ?? "用户" . mt_rand(100, 20000);
            $score       = empty($userInfo["score"]) ? 300 : $userInfo["score"];
            $remark      = empty($userInfo["remark"]) ? "这家伙很懒 什么都没留下" : $userInfo["remark"];
            if (empty($userInfo)) {
                $createUser = $userService->serviceCreate([
                    "uid" => $uid,
                    "openid" => $loginInfo["openid"],
                    "nickname" => $nickname,
                    "score" => $score,
                    "remark" => $remark
                ]);
                if (!$createUser) return ["msg" => "信息记录失败"];
            }
            $tokenKey      = md5($loginInfo["openid"] . time());
            $userCacheInfo = [
                "uid" => $uid,
                "openid" => $loginInfo["openid"],
                "nickname" => $nickname,
                "mobile" => empty($userInfo["mobile"]) ? "" : $userInfo["mobile"],
                "email" => empty($userInfo["mobile"]) ? "" : $userInfo["mobile"],
                "avatar_url" => $userInfo["avatar_url"],
                "score" => $score,
                "remark" => $remark
            ];
            $setUserCache  = Redis::connection()->client()->set($tokenKey, $userCacheInfo, 86400 * 7);
            unset($userCacheInfo["openid"], $uid);
            if ($setUserCache) return ["token" => $tokenKey, "user" => $userCacheInfo];
            return ["msg" => "登录失败"];
        }
        return ["msg" => "登录失败"];
    }
}
