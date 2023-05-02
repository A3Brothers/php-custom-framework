<?php

use System\Route;

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

Route::dispatch(strtolower($httpMethod), $uri);