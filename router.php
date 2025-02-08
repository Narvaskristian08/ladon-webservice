<?php

require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/app/Controllers/UserController.php';

// Define Routes
Router::add('GET', '/users', function() {
    $controller = new UserController();
    $controller->index();
});

Router::add('POST', '/users', function() {
    $controller = new UserController();
    $controller->store();
});

// Dispatch the routes
Router::dispatch();
