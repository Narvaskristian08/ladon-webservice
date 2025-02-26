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
    '/home' => __DIR__ . '/../app/Views/home.php', /*http://localhost:8000/ */
    '/dashboard' => __DIR__ . '/../app/Views/dashboard.php',/*http://localhost:8000/dashboard*/
    '/auth' => __DIR__ . '/../app/Views/auth.php',/* http://localhost:8000/auth*/
    '/inventory' => __DIR__ . '/../app/Views/inventory.php',/*http://localhost:8000/inventory */
    '/settings-admin' => __DIR__ . '/../app/Views/settings-admin.php' /*http://localhost:8000/settings-admin */
];

// If route exists, load the corresponding page
if (isset($routes[$requestUri])) {
    require $routes[$requestUri];
} else {
    http_response_code(404);
    echo "404 Not Found";
}
