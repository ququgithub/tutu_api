<?php
declare(strict_types = 1);

namespace App\Library;

use Godruoyi\Snowflake\Snowflake;

class SnowFlakeId
{
    public static function getId(): string
    {
        return (new Snowflake())->id();
    }
}
