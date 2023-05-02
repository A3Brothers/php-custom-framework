<?php

use System\Route;
use App\Http\Controller\App;
use App\Http\Controller\Cws;
use App\Http\Controller\Info;
use App\Http\Controller\Test;

Route::get('/', [App::class, 'index']);
Route::get('/test', [App::class, 'view']);
Route::get('/home', function(Test $test) {
    echo "Welcome to home page! " . $test->say();
});
route::get('/info', [Info::class, 'index']);
route::get('/server', function () {
    print_r($_SERVER);
});
Route::get('/abdullah', [Cws::class, 'index']);
Route::post('/abdullah', [Cws::class, 'create']);

require_once '../config/routes.php';
