<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Models\Admin\TemplateHistory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class TemplateHistoryController extends AdminController
{
    protected $title = "订阅列表";

    public function grid(): Grid
    {
        $grid = new Grid(new TemplateHistory());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->equal("send_state", "发送结果")->select([1 => "发送成功", 2 => "发送失败", 3 => "待发送"]);
                $filter->equal("is_used", "使用状态")->select([1 => '已发送', 2 => '未发送']);
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->between('created_at', "订阅时间")->datetime();
            });
        });
        $grid->paginate(20);
        $grid->model()->orderByDesc("id");
        $grid->column("uid", "数据编号")->copyable();
        $grid->column("user.avatar_url", "用户头像")->image("", 50, 50);
        $grid->column("user.nickname", "用户昵称");
        $grid->column("template_id", "模板编号")->copyable();
        $grid->column("send_state", "发送结果")->display(function ($send_state) {
            if ($send_state == 1) {
                return "<span style='color:green'>发送成功</span>";
            }
            if ($send_state == 2) {
                return "<span style='color:red'>发送失败</span>";
            }
            return "<span style='color:gray'>待发送</span>";
        });
        $grid->column("is_used", "使用状态")->display(function ($is_used) {
            if ($is_used == 1) {
                return "<span style='color:green;'>已发送</span>";
            }
            if ($is_used == 2) {
                return "<span style='color:grey;'>未发送</span>";
            }
        });
        $grid->column("created_at", "订阅时间");

        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->disableCreateButton();

        return $grid;
    }
}
