<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Library\SnowFlakeId;
use App\Models\Admin\Series;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ImageSeriesController extends AdminController
{
    protected $title = "相册系列";

    public function grid(): Grid
    {
        $grid = new Grid(new Series());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('title', "系列名称");
                $filter->equal('is_show', "上架状态")->select([
                    1 => '上架',
                    2 => '下架',
                ]);
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->between('created_at', "创建时间")->datetime();
            });
        });
        $grid->paginate(10);
        $grid->model()->orderByDesc("id");

        $grid->column("title", "系列名称");
        $grid->column("cover", "系列封面")->image("", 50, 50);
        $grid->column("navigate", "跳转地址");
        $grid->column('is_show', "上架状态")->display(function ($is_show) {
            if ($is_show == 1) {
                return "<span style='color:#059B50'>上架</span>";
            }
            return "<span style='color:#E70F0FFF'>下架</span>";
        });
        $grid->column("orders", "显示顺序");
        $grid->column("created_at", "创建时间");
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new Series());
        $form->hidden("uid", "系列编号")->default(SnowFlakeId::getId());
        $form->hidden("url", "相册地址")->default(env("QINIU_URL"));
        $form->text("title", "系列名称")->rules('required|max:20');
        $form->number("orders", "显示顺序")->default(0)->help("值越大，显示权重越高，最大值99999999");
        $form->radio("is_show", "上架状态")->options([1 => "上架", 2 => "下架"])->default(1);
        $form->image("path", "系列封面")->uniqueName()->required();
        $form->text("navigate", "跳转地址")->help("用户端会根据填写的地址进行跳转，为空则表示跳转相册列表页面");

        return $form;
    }
}
