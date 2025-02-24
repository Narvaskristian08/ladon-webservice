<?php
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/api.php';


$requestUri = $_SERVER['REQUEST_URI'];

// Serve API Requests
if (strpos($requestUri, '/api') === 0) {
    
$authController = new AuthController();

// Auth Routes
Router::add('POST', '/api/register', function() use ($authController) {
    $authController->register();
});

Router::add('POST', '/api/login', function() use ($authController) {
    $authController->login();
});

Router::add('POST', '/api/logout', function() use ($authController) {
    $authController->logout();
});
//Router::add('GET', '/api/user/total', function() use ($authController) {
//    $authController->totalUsers();
//});

// Product Routes
Router::add('GET', '/api/products', function() {
    (new ProductController())->index();
});

Router::add('POST', '/api/products', function() {
    (new ProductController())->store();
});

Router::add('DELETE', '/api/products/{id}', function($id) {
    (new ProductController())->delete($id);
});


Router::dispatch();


}



