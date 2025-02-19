<?php
$requestUri = $_SERVER['REQUEST_URI'];

if (strpos($requestUri, '/api') === 0) {
    require_once __DIR__ . '/../core/api.php';
    exit;
}

// Load frontend view
require_once __DIR__ . '/../app/Views/auth.php';
?>
