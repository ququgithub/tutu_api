<?php
declare(strict_types = 1);

namespace App\Library;

use Godruoyi\Snowflake\Snowflake;

class SnowFlakeId
{
    public static function getId(int $datacenter = null, int $workerid = null): string
    {
        return (new Snowflake($datacenter, $workerid))->id();
    }
}
