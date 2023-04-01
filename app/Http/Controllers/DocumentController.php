<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\DocValidate;
use App\Library\Response;
use App\Logic\User\Service\DocumentService;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function list(): JsonResponse
    {
        return Response::success((new DocumentService())->serviceSelect(request()->all()));
    }

    public function show(DocValidate $validate): JsonResponse
    {
        return Response::success((new DocumentService())->serviceFind($validate->all()));
    }
}
