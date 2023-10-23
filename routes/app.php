<?php

use System\Route;
use App\Http\Controller\{HomeController, AuthController, JsController};
use System\App;
use System\Config;
use System\Container;

$container = new Container;
$route = new Route($container);

$route->get('/', [HomeController::class, 'index']);
$route->get('/register', [AuthController::class, 'index']);
$route->post('/register', [AuthController::class, 'create']);
$route->get('/login', [AuthController::class, 'login']);
$route->post('/login', [AuthController::class, 'postLogin']);
$route->get('/dashboard', [HomeController::class, 'dashboard']);
$route->get('/logout', [AuthController::class, 'logout']);
$route->get('/phpinfo', function () {
    echo phpinfo();
});
$route->get('/js', [JsController::class, 'index']);
$route->get('/promise1', [JsController::class, 'promise1']);


(new App)->make(
    $container,
    $route,
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
    (new Config())
);
