<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\DocumentGroupService;
use Illuminate\Http\JsonResponse;

class DocumentGroupController extends Controller
{
    public function list(): JsonResponse
    {
        return Response::success((new DocumentGroupService())->serviceSelect(request()->all()));
    }
}
