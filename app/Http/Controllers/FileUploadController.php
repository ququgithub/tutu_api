<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Library\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use zgldh\QiniuStorage\QiniuStorage;

class FileUploadController
{
    public function upload(Request $request): JsonResponse
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('file')) {
                $file     = $request->file('file');
                $disk     = QiniuStorage::disk('qiniu');
                $fileName = md5($file->getClientOriginalName() . time() . rand()) . '.' . $file->getClientOriginalExtension();
                $bool     = $disk->put($fileName, file_get_contents($file->getRealPath()));
                if ($bool) {
                    $path = $disk->downloadUrl($fileName);
                    return Response::success(["url" => $path], 100, "上传成功");
                }
                return Response::error([], 101, "上传错误");
            }
            return Response::error([], 101, "上传文件不能为空");
        } else {
            return Response::error([], 101, "上传方式错误");
        }

    }
}
