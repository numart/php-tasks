<?php

declare(strict_types=1);

namespace Numa\Tasks;

class Route
{

    private static array $routes = [];

    public static function get(string $routePattern, callable|array $action)
    {
        self::addRoute('GET', $routePattern, $action);
    }

    public static function post(string $routePattern, callable|array $action)
    {
        self::addRoute('POST', $routePattern, $action);
    }

    private static function addRoute(
      string $method,
      string $routePattern,
      callable|array $action
    ) {
        $routePattern = trim($routePattern, '/');
        $regex = preg_replace('#\{[\w]+\}#', '([\w-]+)', $routePattern);
        $regex = "#^$regex$#";

        self::$routes[$method][] = [
          'pattern' => $routePattern,
          'regex' => $regex,
          'action' => $action,
        ];
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
                    return $action(...$matches);
//                    return call_user_func_array($action, $matches);
                }

                if (is_array($action) && class_exists($action[0])) {
                    $controller = new $action[0]();
                    $methodName = $action[1];
                    return $controller->$methodName(...$matches); // Da problemas con $matches al ser un array, por eso el spread
//                    return call_user_func_array([$controller, $methodName], $matches);
                }
            }
        }

        http_response_code(404);
        echo "Página no encontrada";
    }

}
