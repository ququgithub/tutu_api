<?php
declare(strict_types = 1);

namespace App\Logic\User\Repository;

use App\Models\User\SeriesModel;
use Closure;

class SeriesRepository implements UserRepositoryInterface
{

    public function repositorySelect(Closure $closure, int $perSize, array $searchFields = []): array
    {
        $items = (new SeriesModel())::query()
            ->where($closure)
            ->orderByDesc("orders")
            ->paginate($perSize, $searchFields);

        return [
            "items" => $items->items(),
            "total" => $items->total(),
            "page" => $items->currentPage(),
            "size" => $items->perPage(),
        ];
    }

    public function repositoryCreate(array $insertInfo): bool
    {
        return false;
    }

    public function repositoryFind(Closure $closure, array $searchFields = []): array
    {
        return [];
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
