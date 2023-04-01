<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Library\SnowFlakeId;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Models\Admin\DocumentGroup;

class DocumentGroupController extends AdminController
{
    protected $title = "文档分组";

    public function grid(): Grid
    {
        $grid = new Grid(new DocumentGroup());
        $grid->column("title", "分组标题");
        $grid->column('is_show', "上架状态")->display(function ($is_show) {
            if ($is_show == 1) {
                return "<span style='color:#059B50'>上架</span>";
            }
            return "<span style='color:#E70F0FFF'>下架</span>";
        });
        $grid->column("orders", "显示顺序");
        $grid->column("created_at", "创建时间");
        $grid->column("updated_at", "更新时间");
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new DocumentGroup());
        $form->hidden("uid", "分组编号")->default(SnowFlakeId::getId());
        $form->text("title", "分组标题")->rules('required|max:20')->required();
        $form->radio("is_show", "上架状态")->options([1 => "上架", 2 => "下架"])->default(1);
        $form->number("orders", "显示顺序")->max(10000)->min(1)->default(1)->help("值越大，权重越高");

        return $form;
    }
}
