<?php

function autoload($class)
{
    $dir = str_replace('\\', '/', $class);
    $class = lcfirst($dir) . ".php";
    $filepath = __DIR__ . DIRECTORY_SEPARATOR . $class;
    require($filepath);
}

spl_autoload_register('autoload');
