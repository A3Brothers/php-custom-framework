<?php

namespace App\Http\Middleware;

use App\Facade\Auth;
use System\Contract\MiddlewareInterface;
use App\Facade\View;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        $user = Auth::user()->guest();
        if(Auth::user()->guest()){
            View::withError('Only authenticated users allowed!');
            View::redirect('/');
            exit;
        }
    }
}
