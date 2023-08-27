<?php

class Session
{
    /**
     * Add key to session
     */
    public static function put($key, $message)
    {
        $_SESSION[$key] = $message;
    }

    /**
     * Show and clear key from session
     */
    public static function flash($key)
    {
        if (isset($_SESSION[$key])) {
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
        }
    }

    /**
     * Check if key exists in session
     */
    public static function has($key): bool
    {
        return isset($_SESSION[$key]);
    }
}