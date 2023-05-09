<?php

use System\Route;
use App\Http\Controller\{HomeController, AuthController};
use System\App;
use System\Config;

$route = new Route;
$route->get('/', [HomeController::class, 'index']);
$route->get('/register', [AuthController::class, 'index']);
$route->post('/register', [AuthController::class, 'create']);
$route->get('/login', [AuthController::class, 'login']);
$route->post('/login', [AuthController::class, 'postLogin']);
$route->get('/dashboard', [HomeController::class, 'dashboard']);
$route->get('/logout', [AuthController::class, 'logout']);


(new App)->make($route, $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], (new Config()));
