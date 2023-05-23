<?php

namespace App\Http\Controller;

use App\Facade\View;

class JsController 
{
    public function index() 
    {
        return View::send('js');
    }

    public function promise1() 
    {
        sleep(10);
        return json_encode(['status' => 'success']);
    }
}