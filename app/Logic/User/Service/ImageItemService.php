<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Logic\User\Repository\ImageItemRepository;
use Closure;

class ImageItemService implements UserServiceInterface
{
    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {
            extract($requestParams);
            if (!empty($image_uid)) {
                $query->where("image_uid", "=", $image_uid);
            }
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return (new ImageItemRepository())->repositorySelect(self::searchWhere($requestParams), (int)($requestParams["size"] ?? 20),
            ["url", "path", "author_uid", "user_uid", "created_at as upload_time"]);
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
