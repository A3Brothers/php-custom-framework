<?php

namespace System;

class Session
{
    private static $session;
    private static $sessionStarted = false;

    public function start()
    {
        if (!self::$sessionStarted) {
            session_start();
            self::$sessionStarted = true;
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function forget($key)
    {
        unset($_SESSION[$key]);
    }

    public function pop($key)
    {
        $value = $this->get($key);
        $this->forget($key);
        return $value;
    }

    public function flush()
    {
        $_SESSION = array();
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
    }

    public function getMessage($messageKey)
    {
        if ($this->get('messages') !== null && isset($this->get('messages')[$messageKey])) {
            $message = $this->get('messages')[$messageKey]['message'];
            $stay = $this->get('messages')[$messageKey]['stay'];
            if ($this->get('messages')[$messageKey]['stay'] < 1) {
                unset($_SESSION['messages'][$messageKey]);
                $message = null;
            }else {
                $messages = $this->get('messages');
                $stay -= 1;
                $messages[$messageKey]['stay'] = $stay;
                $this->set('messages', $messages);
            }
            return $message;
        }

        return null;
    }

    public function getInstance()
    {
        return static::$session;
    }
}
