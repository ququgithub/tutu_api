<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Library\SnowFlakeId;
use App\Models\Admin\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class BannerController extends AdminController
{
    protected $title = "轮播图管理";

    public function grid(): Grid
    {
        $grid = new Grid(new Banner());
        $grid->paginate(20);
        $grid->model()->orderByDesc("id");
        $grid->disableFilter();

        $grid->column("uid", "数据编号")->copyable();
        $grid->column("first_title", "一级标题");
        $grid->column("second_title", "二级标题");
        $grid->column("cover", "图片封面")->lightbox(['width' => 50, 'height' => 50]);
        $grid->column("orders", "显示顺序");
        $grid->column("navigate", "跳转地址");
        $grid->column('is_show', "上架状态")->display(function ($is_show) {
            if ($is_show == 1) {
                return "<span style='color:#059B50'>上架</span>";
            }
            return "<span style='color:#E70F0FFF'>下架</span>";
        });
        $grid->column("created_at", "创建时间");
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new Banner());
        $form->hidden("uid", "图片编号")->default(SnowFlakeId::getId());
        $form->text("first_title", "一级标题")->rules('required|max:20');
        $form->text("second_title", "二级标题")->rules('required|max:20');
        $form->text("navigate", "跳转地址");
        $form->hidden("url", "相册地址")->default(env("QINIU_URL"));
        $form->number("orders", "显示权重")->default(0)->min(0)->max(999)->help("值越大，权重越高。最大值999。");
        $form->radio("is_show", "上架状态")->options([1 => "上架", 2 => "下架"])->default(1);
        $form->image("path", "图片封面")->uniqueName()->required();

        return $form;
    }
}
