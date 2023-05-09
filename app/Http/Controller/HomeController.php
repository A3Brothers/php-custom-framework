<?php

namespace App\Http\Controller;

use App\Http\Middleware\AuthMiddleware;
use System\View;

class HomeController
{
    private $authMid;

    public function __construct()
    {
        $this->authMid = new AuthMiddleware;

    }

    public function index()
    {
        echo View::send('home');
    }

    public function dashboard() 
    {
        $this->authMid->handle();
        echo View::send('dashboard');
    }
}