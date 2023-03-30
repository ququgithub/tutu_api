<?php

namespace App\Logic\User\Repository;

use Closure;

interface UserRepositoryInterface
{
    public function repositorySelect(Closure $closure, int $perSize, array $searchFields = []): array;

    public function repositoryCreate(array $insertInfo): bool;

    public function repositoryFind(Closure $closure, array $searchFields = []): array;

    public function repositoryUpdate(array $updateWhere, array $updateInfo): int;

    public function repositoryWhereInDelete(array $deleteWhere, string $field): int;

    public function repositoryDelete(array $deleteWhere): int;
}
