<?php

require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

// Define Routes
Router::add('POST', '/register', function() {
    $controller = new AuthController();
    $controller->register();
});

Router::add('POST', '/login', function() {
    $controller = new AuthController();
    $controller->login();
});

Router::add('POST', '/logout', function() {
    $controller = new AuthController();
    $controller->logout();
});

Router::add('GET', '/user/total', function() {
    $controller = new AuthController();
    $controller->totalUsers();
});

Router::add('DELETE', '/user/{id}', function($id) {
    $controller = new AuthController();
    $controller->deleteUser($id);
});

// Dispatch Routes
Router::dispatch();
