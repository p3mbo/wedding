<?php
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(dirname(__FILE__)));

final class Wedding
{
    const DEFAULT_CURRENCY = '£';

    public static function getUrl($route = '', $params = [])
    {
        $str =  '/' . $route;
        if(!empty($params)) {
            $parsedParams = http_build_query($params);
            $str .= '?' . $parsedParams;
        }

        return $str;

    }

    public static function getPath($route)
    {
        return implode(DS, [BP, '', $route]);
    }

    public static function __($str)
    {
        return htmlspecialchars($str);
    }

    public static function currency($value)
    {
        return sprintf('%s%0.2f', self::DEFAULT_CURRENCY, $value);
    }

    public static function sanitize($string, $force_lowercase = true, $anal = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}