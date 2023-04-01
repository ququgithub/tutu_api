<?php

use App\Admin\Controllers\DocumentController;
use App\Admin\Controllers\DocumentGroupController;
use App\Admin\Controllers\HomeController;
use App\Admin\Controllers\ImageController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
//    'namespace'     => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', [HomeController::class, "index"])->name('home');
    $router->resource("image", ImageController::class);
    $router->resource("documents/group", DocumentGroupController::class);
    $router->resource("documents", DocumentController::class);
});
