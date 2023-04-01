<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::success((new CategoryService())->serviceAll());
    }
}
