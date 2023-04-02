<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

class HomeController extends Controller
{
    public function index(Content $content): Content
    {
        return $content
            ->header('Echarts')
            ->body(new Box('echarts demo', view('admin.echarts')));
    }
}
