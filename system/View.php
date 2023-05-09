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

    public static function send($html, $args = [])
    {

        if (count($args) > 0) {
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

    public static function redirect($path, $args = [])
    {
        if (!empty($args)) {
            $query = http_build_query($args, '', '&', PHP_QUERY_RFC3986);
            $path .= (strpos($path, '?') === false ? '?' : '&') . $query;
        }

        header("Location: $path");
    }

    public static function withSuccess($message)
    {
        self::with('success', $message);
    }

    public static function withError($message)
    {
        self::with('error', $message);
    }

    public static function with($key, $message)
    {
        $session = (new App)->session;
        $messages = $session->get('messages', []);
        $messages[$key] = ["message" => $message, "stay" => 1];
        $session->set('messages', $messages);
    }
}
