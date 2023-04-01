<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentGroupController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix("user")->group(function (Router $router) {
    $router->post("login", [LoginController::class, "login"]);
    $router->get("info", [UserController::class, "info"])->middleware("auth");
    $router->put("update", [UserController::class, "update"])->middleware("auth");
});
Route::prefix("banner")->group(function (Router $router) {
    $router->get("list", [BannerController::class, "list"]);
});
Route::prefix("img")->group(function (Router $router) {
    $router->get("series", [SeriesController::class, "list"]);
    $router->get("list", [ImageController::class, "index"]);
    $router->get("item", [ImageItemController::class, "list"]);
    $router->get("category", [CategoryController::class, "index"]);
});

Route::prefix("file")->group(function (Router $router) {
    $router->post("upload", [FileUploadController::class, "upload"]);
});

Route::prefix("doc")->group(function (Router $router) {
    $router->get("list", [DocumentController::class, "list"]);
    $router->get("show", [DocumentController::class, "show"]);
    $router->get("group", [DocumentGroupController::class, "list"]);
});
