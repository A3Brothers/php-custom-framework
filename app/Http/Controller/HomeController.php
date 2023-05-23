<?php

namespace App\Http\Controller;

use App\Facade\View;
use App\Http\Middleware\AuthMiddleware;
// use System\View;

class HomeController
{
    private $authMid;

    public function __construct()
    {
        $this->authMid = new AuthMiddleware;

    }

    public function index()
    {
        return View::send('home');
    }

    public function dashboard() 
    {
        $this->authMid->handle();
        return View::send('dashboard');
    }
}