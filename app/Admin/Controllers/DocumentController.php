<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Library\SnowFlakeId;
use App\Models\Admin\Document;
use App\Models\Admin\DocumentGroup;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class DocumentController extends AdminController
{
    protected $title = "帮助文档";

    public function grid(): Grid
    {
        $grid = new Grid(new Document());
        $grid->column("group.title", "文章分组");
        $grid->column("title", "文章标题");
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
        $form = new Form(new Document());
        $form->select("group_uid", "文档分组")->options(DocumentGroup::list());
        $form->hidden("uid", "文章编号")->default(SnowFlakeId::getId());
        $form->text("title", "文章标题")->rules('required|max:20')->required();
        $form->radio("is_show", "上架状态")->options([1 => "上架", 2 => "下架"])->default(1);
        $form->number("orders", "显示顺序")->max(10000)->min(1)->default(1)->help("值越大，权重越高");
        $form->UEditor('content', "文档内容")->options(['initialFrameHeight' => 400])->required();

        return $form;
    }
}
