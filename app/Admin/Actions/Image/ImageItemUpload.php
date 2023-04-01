<?php

namespace App\Admin\Actions\Image;

use App\Library\SnowFlakeId;
use Encore\Admin\Actions\Response;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use zgldh\QiniuStorage\QiniuStorage;

class ImageItemUpload extends RowAction
{
    public $name = '上传相册';

    public function handle(Model $model, Request $request): Response
    {
        $fileArray  = $request->file("path");
        $imageArray = [];
        foreach ($fileArray as $value) {
            $disk     = QiniuStorage::disk('qiniu');
            $fileName = md5($value->getClientOriginalName() . time() . rand()) . '.' . $value->getClientOriginalExtension();
            $bool     = $disk->put($fileName, file_get_contents($value->getRealPath()));
            if ($bool) {
                $path         = $disk->downloadUrl($fileName);
                $imageArray[] = [
                    "uid" => SnowFlakeId::getId(),
                    "user_uid" => $request->post("user_uid"),
                    "image_uid" => $request->post("image_uid"),
                    "author_uid" => $request->post("author_uid"),
                    "url" => $request->post("url"),
                    "path" => $fileName,
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ];
            }
        }
        if (DB::table("image_item")->insert($imageArray)) {
            $model::query()->where("uid", "=", $request->post("image_uid"))->increment("item_count", count($imageArray));
            return $this->response()->success('上传成功')->refresh();
        }
        return $this->response->error("上传失败")->refresh();
    }

    public function form()
    {
        $this->hidden("image_uid", "相册编号")->default($this->getRow()->getAttribute("uid"));
        $this->hidden("uid", "相册编号")->default(SnowFlakeId::getId());
        $this->hidden("author_uid", "相册作者")->default("482113284229562466");
        $this->hidden("user_uid", "相册用户")->default("482113284229562466");
        $this->hidden("url", "相册地址")->default(env("QINIU_URL"));
        $this->multipleImage("path", "相册图片")->sortable()->required();
    }

}
