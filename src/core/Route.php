<?php

namespace App\src\core;

class Route
{
    public Request $request;
    protected static array $routes = [];

    /**
     * @param Request $request
     *
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
//    === GET ===
    public static function get($path, $callback)
    {
        $path = strtolower(rtrim('/MVC'.$path,'/'));
        Route::$routes['get'][$path] = $callback;
    }
//    === POST ===
    public static function post($path, $callback): void
    {
        $path = strtolower($path);
        Route::$routes['post'][$path] = $callback;
    }

//    === Run ====
    public static function run()
    {
        $path = strtolower(Request::getPath());
        $method = Request::getMethod();
        $callback = Route::$routes[$method][$path] ?? false;
        if ($callback === false) {
            echo "NOT FOUND";
            exit;
        }
        if (is_string($callback)) {
            return Route::render($callback);
        }
        return call_user_func($callback);
    }

    public static function render($view)
    {
        include_once __DIR__."/../views/client/$view.php";
    }

}
