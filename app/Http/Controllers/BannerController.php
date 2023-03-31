<?php

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\BannerService;
use Illuminate\Http\JsonResponse;

class BannerController extends Controller
{
    public function list(): JsonResponse
    {
        return Response::success((new BannerService())->serviceSelect(request()->all()));
    }
}
