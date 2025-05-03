<?php

declare(strict_types=1);

namespace Numa\Tasks;

class Route
{

    private static array $routes = [];

    public static function get($uri, $action)
    {
        self::$routes['GET'][trim($uri, '/')] = $action;
    }

    public static function post($uri, $action)
    {
        self::$routes['POST'][trim($uri, '/')] = $action;
    }

    public function dispatch()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        //        if(is_array($uri)){
        //            $path = '/';
        //        } else {
        //            $uriArr = explode('/', $uri);
        //            $path = $uriArr[1] ?? '';
        //            $param = $uriArr[2] ?? null;
        //        }

        $route = self::$routes[$method][$uri] ?? null;

        if (!$route) {
            http_response_code(404);
            echo "Página no encontrada";
            exit;
        }

        if (is_callable($route)) {
            $route();
            exit;
        }

        if (is_array($route) && class_exists($route[0])) {
            $controller = new $route[0]();
            $methodName = $route[1];
            $controller->$methodName();
            exit;
        }

        http_response_code(500);
        echo "Error al procesar la ruta";
    }

}
