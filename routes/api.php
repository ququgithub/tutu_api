<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix("user")->group(function (Router $router) {
    $router->post("login", [LoginController::class, "login"]);
    $router->get("info", [UserController::class, "info"])->middleware("auth");
});
