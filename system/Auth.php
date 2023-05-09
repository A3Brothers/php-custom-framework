<?php

namespace System;

class Auth 
{
    private static $user = null;

    public function user()
    {
        static::$user = ((new App)->session)->get('user');
        return $this;
    }

    public function __get($name)
    {
        if(isset(static::$user[$name])) return static::$user[$name];
        else return null;
    }

    public function __call($name, $arguments)
    {
        if(isset(static::$user[$name])) return static::$user[$name];
        else return null;
    }

    public function logout()
    {
        ((new App)->session)->destroy();
    }

    public function check()
    {
        return ((new App)->session)->has('user');
    }

    public function guest()
    {
        return ! $this->check();
    }

}