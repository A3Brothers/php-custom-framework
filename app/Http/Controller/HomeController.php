<?php

namespace App\Http\Controller;

use System\View;

class HomeController
{
    public function index()
    {
        echo View::send('home');
    }

    public function dashboard() 
    {
        echo View::send('dashboard');
    }
}