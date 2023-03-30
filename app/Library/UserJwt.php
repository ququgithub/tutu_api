<?php
declare(strict_types = 1);

namespace App\Library;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserJwt
{
    public static function encodeJwt(array $userInfo): string
    {
        $payload = [
            'iss' => 'https://www.baidu.com/',
            'aud' => 'https://www.baidu.com/',
            'iat' => 1356999524,
            'nbf' => 1357000000,
            "userInfo" => $userInfo
        ];
        return JWT::encode($payload, env("JWT_KEY"), 'HS256');
    }

    public static function decodeJwt(string $jwt): array
    {
        $jwt = (array)JWT::decode($jwt, new Key(env("JWT_KEY"), 'HS256'));
        return (array)$jwt["userInfo"];
    }
}
