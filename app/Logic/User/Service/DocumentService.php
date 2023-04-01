<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Logic\User\Repository\DocumentRepository;
use Closure;

class DocumentService implements UserServiceInterface
{

    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {
            $query->where("is_show", "=", 1);
            extract($requestParams);
            if (!empty($uid)) {
                $query->where("uid", "=", $uid);
            }
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return (new DocumentRepository())->repositorySelect(self::searchWhere($requestParams), (int)($requestParams["size"] ?? 20),
            ["uid", "title"]);
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
        return (new DocumentRepository())->repositoryFind(self::searchWhere($requestParams), ["content"]);
    }
}
