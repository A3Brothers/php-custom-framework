<?php

namespace System;

class View
{
    public static function render($view)
    {
        ob_start();
        include BASEPATH . 'views/' . $view . '.php';
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    public static function send($html, $args = []) {

        if(count($args) > 0) {
            foreach ($args as $key => $value) {
                $$key =  $args[$key];
            }
        }
        ob_start();
        include BASEPATH . 'views/' . $html . '.php';
        $view = ob_get_contents();
        ob_end_clean();
        return $view;

    }
}
