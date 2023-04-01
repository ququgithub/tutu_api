<?php
declare(strict_types = 1);

namespace App\Logic\User\Service;

use App\Library\SnowFlakeId;
use App\Logic\User\Repository\TemplateHistoryRepository;
use Closure;

class TemplateHistoryService extends BaseService implements UserServiceInterface
{

    public static function searchWhere(array $requestParams): Closure
    {
        return function ($query) use ($requestParams) {

        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return [];
    }

    public function serviceCreate(array $requestParams): array
    {
        $insertRecord = (new TemplateHistoryRepository())->repositoryCreate([
            "uid" => SnowFlakeId::getId(),
            "template_id" => $requestParams["template_id"],
            "user_uid" => $this->getUserUid(),
            "is_used" => 2,
            "send_sate" => 3,
        ]);

        if ($insertRecord) {
            return ["code" => 1, "msg" => "订阅成功"];
        }
        return ["code" => 2, "msg" => "订阅失败"];
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
