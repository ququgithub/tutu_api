<?php

namespace Database\Seeders;

use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Seeder;

class Category extends Seeder
{
    public function run()
    {
        $snowFlake = new Snowflake();
        $tables    = [
            ["title" => "推荐", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "美食", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "唯美", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "动漫", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "风景", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "手绘", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "萌宠", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "星空", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "文艺", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "趣味", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "商务", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "明星", "uid" => $snowFlake->id(), "is_show" => 1],
            ["title" => "春天", "uid" => $snowFlake->id(), "is_show" => 1],
        ];
        foreach ($tables as $value) {
            (new \App\Models\Category())::query()->create($value);
        }
    }
}
