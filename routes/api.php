<?php

use App\Http\Controllers\BannerController;
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
});
