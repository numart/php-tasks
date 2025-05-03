<?php

declare(strict_types=1);

namespace Numa\Tasks;


class Route {

    private static array $routes = [];

    public static function get($uri, $action){
        self::$routes['GET'][$uri] = $action;
    }

    public function execute(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $uriArr = explode('/', $uri);
        $path = $uriArr[1] ?? '';
        $param = $uriArr[2] ?? null;

        if(isset(self::$routes[$method][$path])){
            call_user_func(self::$routes[$method][$path]);
        }


    }

}
