<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Models\Admin\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class UserController extends AdminController
{
    protected $title = "用户列表";

    public function grid(): Grid
    {
        $grid = new Grid(new User());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('nickname', "用户昵称");
                $filter->like('name', "用户姓名");
                $filter->like('email', "邮箱账号");
                $filter->equal("profession", "用户职业")->select(['计算机/电子', '高级UI设计', '会计/金融', '政府/非盈利组织/其他']);
                $filter->equal("gender", "用户性别")->select(['保密', '男', '女']);
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->between('score', "用户积分");
                $filter->between('production_count', "作品数量");
                $filter->between('invite_count', "邀请人数");
                $filter->between('created_at', "注册时间")->datetime();
                $filter->between('birthday', "用户生日")->date();
            });
        });
        $grid->paginate(15);
        $grid->model()->orderByDesc("id");
        $grid->column("uid", "用户编号")->copyable();
        $grid->column("avatar_url", "用户头像")->image("", 50, 50);
        $grid->column("nickname", "用户昵称");
        $grid->column("name", "用户姓名");
        $grid->column("openid", "用户OpenId")->copyable();
        $grid->column("mobile", "手机号");
        $grid->column("email", "邮箱");
        $grid->column("age", "用户年龄");
        $grid->column("gender", "用户性别")->display(function ($gender) {
            if ($gender == 1) {
                return "<span style='color:blue'>男</span>";
            }
            if ($gender == 2) {
                return "<span style='color:#FFB6C1'>女</span>";
            }
            return "<span style='color:gray'>未知</span>";
        });
        $grid->column("score", "用户积分");
        $grid->column("production_count", "作品数量");
        $grid->column("invite_count", "邀请人数");
        $grid->column("created_at", "注册时间");

        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->disableCreateButton();

        return $grid;
    }
}
