<?php

namespace Wedding;

class Session
{
    protected static $ns = 'wedding/session';

    public static function setData($key, $value)
    {
        $_SESSION[self::$ns][$key] = $value;
    }

    public static function getData($key)
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
