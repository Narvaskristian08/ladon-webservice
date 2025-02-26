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
            // ✅ Convert {id} placeholders to dynamic regex matching
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([0-9]+)', $route['route']);
            if ($route['method'] === $requestMethod && preg_match("#^$pattern$#", $requestUri, $matches)) {
                array_shift($matches); // Remove full match
                call_user_func_array($route['callback'], $matches);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Route Not Found"]);
    }
}
