<?php

class Router {
    private static $routes = [];

    public static function add($method, $route, $callback) {
        self::$routes[] = ['method' => strtoupper($method), 'route' => $route, 'callback' => $callback];
    }

    public static function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && $route['route'] === $requestUri) {
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Route Not Found"]);
    }
}
