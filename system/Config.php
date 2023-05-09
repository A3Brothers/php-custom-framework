<?php

namespace System;

class Config
{
    private static $config;

    public function __construct()
    {
        $files = glob(BASEPATH . 'config/*.php');
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if(!isset(static::$config[$filename])){
                static::$config[$filename] = require_once $file;
            }
        }
    }

    public function config()
    {
        return static::$config;
    }

}