<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Library\SnowFlakeId;
use App\Models\Admin\EmoGroup;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class EmoGroupController extends AdminController
{
    protected $title = "分组管理";

    public function grid(): Grid
    {
        $grid = new Grid(new EmoGroup());
        $grid->paginate(15);
        $grid->model()->orderByDesc("id");
        $grid->disableFilter();

        $grid->column("uid", "数据编号")->copyable();
        $grid->column("title", "分组名称");
        $grid->column("views", "阅读数量");
        $grid->column("count", "图片数量");
        $grid->column('is_show', "上架状态")->display(function ($is_show) {
            if ($is_show == 1) {
                return "<span style='color:#059B50'>上架</span>";
            }
            return "<span style='color:#E70F0FFF'>下架</span>";
        });
        $grid->column("created_at", "创建时间");
        $grid->column("updated_at", "创建时间");
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new EmoGroup());
        $form->hidden("uid", "图片编号")->default(SnowFlakeId::getId());
        $form->text("title", "一级标题")->rules('required|max:20');
        $form->radio("is_show", "上架状态")->options([1 => "上架", 2 => "下架"])->default(1);

        return $form;
    }
}
