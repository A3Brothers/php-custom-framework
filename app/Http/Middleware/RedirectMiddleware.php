<?php

namespace App\Http\Middleware;

use App\Facade\Auth;
use System\Contract\MiddlewareInterface;
use App\Facade\View;

class RedirectMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        Auth::user()->guest();
        if (!Auth::user()->guest()) {
            View::withError('Only guest users allowed!');
            View::redirect('/');
            exit;
        }
    }
}
