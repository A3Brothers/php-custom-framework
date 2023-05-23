<?php

namespace System;

class View
{

    public function render($view)
    {
        ob_start();
        include BASEPATH . 'views/' . $view . '.php';
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    public function send($html, $args = [])
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

    public function redirect($path, $args = [])
    {
        if (!empty($args)) {
            $query = http_build_query($args, '', '&', PHP_QUERY_RFC3986);
            $path .= (strpos($path, '?') === false ? '?' : '&') . $query;
        }
        header("Location: $path");
    }

    public function withSuccess($message)
    {
        $this->with('success', $message);
    }

    public function withError($message)
    {
        $this->with('error', $message);
    }

    public function with($key, $message)
    {
        $session = (new App)->session;
        $messages = $session->get('messages', []);
        $messages[$key] = ["message" => $message, "stay" => 1];
        $session->set('messages', $messages);
    }
}
