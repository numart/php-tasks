<?php

declare(strict_types=1);

namespace Numa\Tasks;

class Route
{

    private static array $routes = [];

    public static function get(string $routePattern, $action)
    {
        $routePattern = trim($routePattern, '/');
        $regex = preg_replace('#\{[\w]+\}#', '([\w-]+)', $routePattern);
        $regex = "#^$regex$#";

        self::$routes['GET'][] = [
          'pattern' => $routePattern,
          'regex' => $regex,
          'action' => $action,
        ];
    }

    public static function post($uri, $action)
    {
        self::$routes['POST'][trim($uri, '/')] = $action;
    }

    public function dispatch()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        $routes = self::$routes[$httpMethod] ?? [];

        foreach ($routes as $route) {
            if (preg_match($route['regex'], $uri, $matches)) {
                array_shift(
                  $matches
                ); // elimina el match completo, deja solo parámetros

                $action = $route['action'];

                if (is_callable($action)) {
                    call_user_func_array($action, $matches);
                    return;
                }

                if (is_array($action) && class_exists($action[0])) {
                    $controller = new $action[0]();
                    $methodName = $action[1];
                    call_user_func_array([$controller, $methodName], $matches);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "Página no encontrada";
    }

}
