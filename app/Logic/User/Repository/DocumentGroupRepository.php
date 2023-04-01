<?php
declare(strict_types = 1);

namespace App\Logic\User\Repository;

use App\Models\User\DocumentGroup;
use Closure;

class DocumentGroupRepository implements UserRepositoryInterface
{

    public function repositorySelect(Closure $closure, int $perSize, array $searchFields = []): array
    {
        return (new DocumentGroup())::query()
            ->with(["doc:uid,group_uid,title"])
            ->where($closure)
            ->get($searchFields)
            ->toArray();
    }

    public function repositoryCreate(array $insertInfo): bool
    {
        // TODO: Implement repositoryCreate() method.
    }

    public function repositoryFind(Closure $closure, array $searchFields = []): array
    {
        return [];
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
