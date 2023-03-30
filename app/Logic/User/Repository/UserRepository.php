<?php
declare(strict_types = 1);

namespace App\Logic\User\Repository;

use App\Models\User\UserModel;
use Closure;

class UserRepository implements UserRepositoryInterface
{

    public function repositorySelect(Closure $closure, int $perSize, array $searchFields = []): array
    {
        return [];
    }

    public function repositoryCreate(array $insertInfo): bool
    {
        $userModel = (new UserModel())::query()->create($insertInfo);

        return !empty($userModel->getKey());

    }

    public function repositoryFind(Closure $closure, array $searchFields = []): array
    {
        $bean = (new UserModel())::query()->where($closure)->first($searchFields);

        return !empty($bean) ? $bean->toArray() : [];
    }

    public function repositoryUpdate(array $updateWhere, array $updateInfo): int
    {
        return 0;
    }

    public function repositoryWhereInDelete(array $deleteWhere, string $field): int
    {
        return 0;
    }

    public function repositoryDelete(array $deleteWhere): int
    {
        return 0;
    }
}
