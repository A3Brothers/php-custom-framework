<?php

namespace App\Http\Controller;

use System\View;

class Cws 
{
    public static function index(Test $test)
    {
        $name = $test->say();
        $age = 20;
        echo View::send('cws', compact('name', 'age'));
    }

    public static function create()
    {
        echo "<pre>";
        var_dump($_POST);
        echo "<pre>";
    }
}