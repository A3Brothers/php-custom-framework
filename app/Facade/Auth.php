<?php

namespace App\Facade;

use System\Facade\BaseFacade;
use System\Auth as SystemAuth;

class Auth extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return SystemAuth::class;
    }
}