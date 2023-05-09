<?php

use System\App;

if(!function_exists('sessionMessages')) {
    function sessionMessages($key) {
        $session = (new App)->session;
        $message = $session->getMessage($key);
        return $message;
    }
}