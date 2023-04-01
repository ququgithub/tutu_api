<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\TemplateSubscribeValidate;
use App\Library\Response;
use App\Logic\User\Service\TemplateHistoryService;
use Illuminate\Http\JsonResponse;

class TemplateController extends Controller
{
    public function subscribe(TemplateSubscribeValidate $validate): JsonResponse
    {
        return Response::success((new TemplateHistoryService())->serviceCreate(request()->all()));
    }
}
