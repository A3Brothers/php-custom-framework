<?php

namespace App\Http\Middleware;

use System\Auth;
use System\Contract\MiddlewareInterface;
use System\View;

class RedirectMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        $auth = new Auth;
        $user = $auth->user()->guest();
        if(!$auth->user()->guest()){
            View::withError('Only guest users allowed!');
            View::redirect('/');
            exit;
        }
    }
}
