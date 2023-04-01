<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\ImageUidValidate;
use App\Library\Response;
use App\Logic\User\Service\ImageItemService;
use Illuminate\Http\JsonResponse;

class ImageItemController extends Controller
{
    public function list(ImageUidValidate $imageUidValidate): JsonResponse
    {
        return Response::success((new ImageItemService())->serviceSelect(request()->all()));
    }

    public function download(): JsonResponse
    {
        return Response::success((new ImageItemService())->serviceFind(request()->all()));
    }
}
