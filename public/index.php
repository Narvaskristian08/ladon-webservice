

<?php

$requestUri = $_SERVER['REQUEST_URI'];

// Serve API Requests
if (strpos($requestUri, '/api') === 0) {
    require_once __DIR__ . '/../core/api.php';
    exit;
}

// Custom Routes for Frontend Pages
$routes = [
    '/' => __DIR__ . '/../app/Views/home.php', /*http://localhost:8000/ */
    '/dashboard' => __DIR__ . '/../app/Views/dashboard.php',/*http://localhost:8000/dashboard*/
    '/auth' => __DIR__ . '/../app/Views/auth.php',/* http://localhost:8000/auth*/
    '/inventory' => __DIR__ . '/../app/Views/inventory.php'/*http://localhost:8000/inventory */
];

if (isset($routes[$requestUri])) {
    require $routes[$requestUri];
} else {
    http_response_code(404);
    echo "404 Not Found";
}


// Load frontend view


