<?php

use System\App;
use System\Auth;

if (!function_exists('sessionMessages')) {
    function sessionMessages($key)
    {
        $session = (new App)->session;
        $message = $session->getMessage($key);
        return $message;
    }
}

if (!function_exists('auth')) {
    function auth()
    {
        $auth = new Auth();
        if (!$auth->guest()) return true;
    }
}
