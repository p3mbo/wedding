<?php

namespace Wedding;

class Registry
{
    protected static $ns = 'wedding/registry';

    public static function register($key, $value)
    {
        $_SESSION[self::$ns][$key] = $value;
    }

    public static function registry($key)
    {
        if(isset($_SESSION[self::$ns][$key])) {
            return $_SESSION[self::$ns][$key];
        }

        return null;
    }

    public static function clear()
    {
        unset($_SESSION[self::$ns]);
    }
}
