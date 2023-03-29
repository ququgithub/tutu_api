<?php

namespace Database\Seeders;

use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Seeder;

class Banner extends Seeder
{
    public function run()
    {
        $snowFlake = new Snowflake();
        $tables    = [
            ["first_title" => "酷炫多彩", "second_title" => "更多彩蛋等你探索", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "adno4.jpeg	", "is_show" => 1, "navigate" => ""],
            ["first_title" => "海量分享", "second_title" => "总有你想不到的创意", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "adno2.jpeg	", "is_show" => 1, "navigate" => ""],
            ["first_title" => "合作勾搭", "second_title" => "所有源码全部提供", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "adno3.jpeg", "is_show" => 1, "navigate" => ""],
            ["first_title" => "适配多端", "second_title" => "APP、微信小程序、H5、Finclip", "uid" => $snowFlake->id(), "url" => "http://qiniucloud.qqdeveloper.com/", "path" => "adno5.jpeg", "is_show" => 1, "navigate" => ""],
        ];
        foreach ($tables as $value) {
            (new \App\Models\Banner())::query()->create($value);
        }
    }
}
