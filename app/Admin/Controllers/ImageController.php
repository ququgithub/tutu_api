<?php
declare(strict_types = 1);

namespace App\Admin\Controllers;

use App\Admin\Actions\Image\ImageItemUpload;
use App\Library\SnowFlakeId;
use App\Models\Admin\Category;
use App\Models\Admin\Image;
use App\Models\Admin\Series;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ImageController extends AdminController
{
    protected $title = "相册列表";

    public function grid(): Grid
    {
        $grid = new Grid(new Image());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('title', "相册名称");
                $filter->equal('is_show', "上架状态")->radio([
                    1 => '上架',
                    2 => '下架',
                ]);
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->between('created_at', "创建时间")->datetime();
            });
        });
        $grid->paginate(15);
        $grid->model()->orderByDesc("id");

        $grid->column("user.nickname", "用户昵称");
        $grid->column("category.title", "相册类型");
        $grid->column("series.title", "相册系列");
        $grid->column("title", "相册名称");
        $grid->column("cover", "相册封面")->image("", 50, 50)->lightbox(['width' => 50, 'height' => 50]);
        $grid->column("download", "下载次数");
        $grid->column("collect", "收藏次数");
        $grid->column("item_count", "相册数量");
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
            $actions->add(new ImageItemUpload());
        });
        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new Image());
        $form->hidden("uid", "相册编号")->default(SnowFlakeId::getId());
        $form->hidden("author_uid", "相册作者")->default(env("AUTHOR_ID"));
        $form->hidden("user_uid", "相册用户")->default(env("ADMIN_ID"));
        $form->hidden("url", "相册地址")->default(env("QINIU_URL"));
        $form->select("series_uid", "相册系列")->options(Series::getList())->required();
        $form->select("category_uid", "相册系列")->options(Category::getList())->required();
        $form->text("title", "相册名称")->rules('required|max:20');
        $form->number("download", "下载次数")->default(mt_rand(100, 9999));
        $form->number("collect", "收藏次数")->default(mt_rand(100, 9999));
        $form->radio("is_show", "上架状态")->options([1 => "上架", 2 => "下架"])->default(1);
        $form->image("path", "相册封面")->uniqueName()->required();

        return $form;
    }
}
