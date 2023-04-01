<?php
declare(strict_types = 1);

namespace App\Models\Admin;

class DocumentGroup extends \App\Models\DocumentGroup
{
    public static function list(): array
    {
        $items = self::query()->where([
            ["is_show", "=", 1],
        ])->get(["uid", "title"]);
        $array = [];
        foreach ($items as $value) {
            $array[$value->uid] = $value->title;
        }
        return $array;
    }
}
