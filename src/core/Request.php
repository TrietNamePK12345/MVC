<?php

namespace App\src\core;

class Request
{
    public static function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $pathRtrim = rtrim($path, '/');
        $position = strpos($path, '?');
        if ($position === false) {
            return $pathRtrim;
        }
        return substr($pathRtrim, 0, $position);

    }

    public static function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}