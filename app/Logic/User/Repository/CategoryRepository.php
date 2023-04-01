<?php
declare(strict_types = 1);

namespace App\Logic\User\Repository;

use App\Models\User\CategoryModel;
use Closure;

class CategoryRepository implements UserRepositoryInterface
{

    public function repositoryAll(): array
    {
        return (new CategoryModel())::query()
            ->with(["image:uid,title,url,path,category_uid"])
            ->where([["is_show", "=", 1]])
            ->orderByDesc("orders")
            ->get(["uid", "title"])
            ->toArray();
    }

    public function repositorySelect(Closure $closure, int $perSize, array $searchFields = []): array
    {
        // TODO: Implement repositorySelect() method.
    }

    public function repositoryCreate(array $insertInfo): bool
    {
        // TODO: Implement repositoryCreate() method.
    }

    public function repositoryFind(Closure $closure, array $searchFields = []): array
    {
        // TODO: Implement repositoryFind() method.
    }

    public function repositoryUpdate(array $updateWhere, array $updateInfo): int
    {
        // TODO: Implement repositoryUpdate() method.
    }

    public function repositoryWhereInDelete(array $deleteWhere, string $field): int
    {
        // TODO: Implement repositoryWhereInDelete() method.
    }

    public function repositoryDelete(array $deleteWhere): int
    {
        // TODO: Implement repositoryDelete() method.
    }
}
