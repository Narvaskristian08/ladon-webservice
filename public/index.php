<?php

$requestUri = $_SERVER['REQUEST_URI'];

// Redirect root '/' to '/home'
if ($requestUri === '/' || $requestUri === '/index.php') {
    header("Location: /home");
    exit;
}

// Serve API Requests
if (strpos($requestUri, '/api') === 0) {
    require_once __DIR__ . '/../core/api.php';
    exit;
}

// Custom Routes for Frontend Pages
$routes = [
    '/home' => __DIR__ . '/../app/Views/home.php',
    '/dashboard' => __DIR__ . '/../app/Views/dashboard.php',
    '/auth' => __DIR__ . '/../app/Views/auth.php'
];

// If route exists, load the corresponding page
if (isset($routes[$requestUri])) {
    require $routes[$requestUri];
} else {
    http_response_code(404);
    echo "404 Not Found";
}
