<?php

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\SeriesService;
use Illuminate\Http\JsonResponse;

class SeriesController extends Controller
{
    public function list(): JsonResponse
    {
        return Response::success((new SeriesService())->serviceSelect(request()->all()));
    }
}
