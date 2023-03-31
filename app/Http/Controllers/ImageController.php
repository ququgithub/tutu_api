<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\ImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::success((new ImageService())->serviceSelect(request()->all()));
    }
}
