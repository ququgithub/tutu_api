<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Logic\User\Repository\SeriesRepository;
use Closure;

class SeriesService implements UserServiceInterface
{
    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {
            extract($requestParams);
            $query->where("is_show", "=", 1);
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return (new SeriesRepository())->repositorySelect(self::searchWhere($requestParams),
            (int)($requestParams["size"] ?? 20), ["title", "url", "path", "navigate"]);
    }

    public function serviceCreate(array $requestParams): array
    {
        return [];
    }

    public function serviceUpdate(array $requestParams): array
    {
        return [];
    }

    public function serviceDelete(array $requestParams): int
    {
        return 0;
    }

    public function serviceFind(array $requestParams): array
    {
        return [];
    }
}
