<?php

namespace App\Logic\User\Service;

interface UserServiceInterface
{
    public static function searchWhere(array $requestParams);

    public function serviceSelect(array $requestParams): array;

    public function serviceCreate(array $requestParams): array;

    public function serviceUpdate(array $requestParams): array;

    public function serviceDelete(array $requestParams): int;

    public function serviceFind(array $requestParams): array;
}
