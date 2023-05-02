<?php

namespace System;

class View
{
    public static function render($view)
    {
        $content = file_get_contents(BASEPATH . 'views/' . $view . '.php');
        ob_start();
        return include BASEPATH . 'views/' . $view . '.php';
        ob_end_clean();
    }

    public static function send($html, $args = []) {
        // print_r($args);
        $html = self::render($html);

        $arr = null;

        if(count($args) > 0) {
            
            array_walk($args, function($value, $key) use(&$arr){
                $arr["/\{\{\\\${$key}\}\}/"] = fn($match) => $value;
            });
            // print_r($arr);
            $html = preg_replace_callback_array($arr, $html);
            return $html;
        } else {
            return $html;
        }

    }
}
