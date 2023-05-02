<?php
namespace App\Http\Controller;

use System\View;

class Info 
{
    public static function index() {
        $name = "Sanjay";
        echo View::send('info', compact('name'));

    }
}