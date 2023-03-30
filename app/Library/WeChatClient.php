<?php
declare(strict_types = 1);

namespace App\Library;

use EasyWeChat\Factory;
use EasyWeChat\MiniProgram\Application;

class WeChatClient
{
    public static function client(): Application
    {
        return Factory::miniProgram([
            'app_id' => env("WX_ID"),
            'secret' => env("WX_KEY"),
            'response_type' => 'array',
        ]);

    }
}
