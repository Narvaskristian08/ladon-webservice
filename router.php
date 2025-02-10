<?php

require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

// Define Routes

Router::add('get', 'api/user/total', function() {
    $controller = new AuthController();
    $controller->totalUsers();
});
