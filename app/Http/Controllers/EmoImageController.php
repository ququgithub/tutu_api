<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Library\Response;
use App\Logic\User\Service\EmoImageService;
use Illuminate\Http\JsonResponse;

class EmoImageController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::success((new EmoImageService())->serviceSelect(request()->all()));
    }
}
