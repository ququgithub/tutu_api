<?php

namespace Database\Seeders;

use App\Models\Series;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Seeder;

class ImageSeries extends Seeder
{
    public function run()
    {
        $snowFlake = new Snowflake();
        $tables    = [
            ["title" => "人物写真", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "B1.png", "is_show" => 1],
            ["title" => "动漫壁纸", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "A1.png", "is_show" => 1],
            ["title" => "风景系列", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "B7.png", "is_show" => 1],
            ["title" => "苹果专属", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "B5.png", "is_show" => 1],
        ];
        foreach ($tables as $value) {
            (new Series())::query()->create($value);
        }
    }
}
