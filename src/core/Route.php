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
        self::$routes['get'][$path] = $callback;
    }
//    === POST ===
    public static function post($path, $callback)
    {
        $path = strtolower($path);
        self::$routes['post'][$path] = $callback;
    }

//    === Run ====
    public static function run()
    {
        $path = strtolower(Request::getPath());
        $method = Request::getMethod();
        $callback = self::$routes[$method][$path] ?? false;
        if ($callback === false) {
            echo "NOT FOUND";
            exit;
        }
        if (is_string($callback)) {
            echo self::render($callback);
            exit;
        }
        echo call_user_func($callback);
    }

    public static function render($view)
    {
        $layoutContent = self::layoutContent();
        $viewContent = self::renderOnlyView($view);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    protected static function layoutContent()
    {
        ob_start();
        include_once __DIR__."/../views/layouts/client/main.php";
        return ob_get_clean();
    }

    protected static function renderOnlyView($view)
    {
        ob_start();
        include_once __DIR__."/../views/$view.php";
        return ob_get_clean();
    }

}
