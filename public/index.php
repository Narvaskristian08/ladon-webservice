

<?php

$requestUri = $_SERVER['REQUEST_URI'];

// Serve API Requests
if (strpos($requestUri, '/api') === 0) {
    require_once __DIR__ . '/../core/api.php';
    exit;
}

// Custom Routes for Frontend Pages
$routes = [
    '/' => __DIR__ . '/../app/Views/home.php',
    '/dashboard' => __DIR__ . '/../app/Views/dashboard.php',
    '/auth' => __DIR__ . '/../app/Views/auth.php'
];

if (isset($routes[$requestUri])) {
    require $routes[$requestUri];
} else {
    http_response_code(404);
    echo "404 Not Found";
}


// Load frontend view


