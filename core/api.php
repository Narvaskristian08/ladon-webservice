<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

// Define API routes
Router::add('GET', '/api/user/total', function() {
    $controller = new AuthController();
    $controller->totalUsers();
});

Router::add('POST', '/api/login', function() {
    $controller = new AuthController();
    $controller->login();
});

Router::dispatch();
exit; // Make sure the script stops executing after dispatch
