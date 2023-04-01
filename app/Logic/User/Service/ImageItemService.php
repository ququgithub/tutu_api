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
            if (!empty($image_item_uid)) {
                $query->where("uid", "=", $image_item_uid);
            }
        };
    }

    public function serviceSelect(array $requestParams): array
    {
        return (new ImageItemRepository())->repositorySelect(self::searchWhere($requestParams), (int)($requestParams["size"] ?? 20),
            ["url", "path", "author_uid", "user_uid", "created_at as upload_time", "uid"]);
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
        if (isset($requestParams["image_uid"])) {
            $image = (new ImageItemRepository())->repositoryFind(self::searchWhere([
                "image_item_uid" => $requestParams["image_uid"]
            ]), ["url", "path"]);
            if (count($image) > 0) {
                return [
                    "code" => 1,
                    "msg" => "请求成功",
                    "url" => str_replace("http", "https", $image["url"]) . $image["path"],
                    "template_id" => "rF4db7Etb86eqK7iD0FF8MEhLL6z9Vi7sjukCPOhPHQ", // 后端返回，避免修改模板，每次都要重新发布一次微信小程序
                ];
            }
        }
        return [
            "code" => 2,
            "url" => "",
            "msg" => "图片暂无法下载",
            "template_id" => "rF4db7Etb86eqK7iD0FF8MEhLL6z9Vi7sjukCPOhPHQ"
        ];
    }
}
