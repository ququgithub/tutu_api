<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Logic\User\Repository\ImageRepository;
use Closure;

class ImageService implements UserServiceInterface
{

    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {
            extract($requestParams);
            if (!empty($series_uid)) {
                $query->where("series_uid", "=", $series_uid);
            }
            if (!empty($category_uid)) {
                $query->where("category_uid", "=", $category_uid);
            }
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return (new ImageRepository())->repositorySelect(self::searchWhere($requestParams), (int)($requestParams["size"] ?? 20), [
            "uid", "user_uid", "author_uid", "series_uid", "category_uid", "url", "path", "title", "download"
        ]);
    }

    public function serviceCreate(array $requestParams): array
    {
        // TODO: Implement serviceCreate() method.
    }

    public function serviceUpdate(array $requestParams): array
    {
        // TODO: Implement serviceUpdate() method.
    }

    public function serviceDelete(array $requestParams): int
    {
        // TODO: Implement serviceDelete() method.
    }

    public function serviceFind(array $requestParams): array
    {
        // TODO: Implement serviceFind() method.
    }
}
