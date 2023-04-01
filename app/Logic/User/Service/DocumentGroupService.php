<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Logic\User\Repository\DocumentGroupRepository;
use App\Logic\User\Repository\DocumentRepository;
use App\Models\User\DocumentGroup;
use Closure;

class DocumentGroupService implements UserServiceInterface
{

    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {
            $query->where("is_show", "=", 1);
            extract($requestParams);
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return (new DocumentGroupRepository())->repositorySelect(self::searchWhere($requestParams), (int)($requestParams["size"] ?? 20),
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
        return [];
    }
}
