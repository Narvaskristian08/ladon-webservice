<?php

// Load Router
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/api.php';
require_once __DIR__ . '/app/Controllers/ProductController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';


$requestUri = $_SERVER['REQUEST_URI'];



// Serve API Requests
if (strpos($requestUri, '/api') === 0) {
    
$authController = new AuthController();
$prodController = new ProductController();

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
Router::add('GET', '/api/user/total', function() use ($authController) {
    $authController->totalUsers();
});


// Product Routes

// ✅ Get all products
Router::add('GET', '/api/products', function() {
    (new ProductController())->index();
});

// ✅ Get a single product (needed for editing)
Router::add('GET', '/api/products/{id}', function($id) {
    (new ProductController())->show($id);
});


// ✅ Add a product
Router::add('POST', '/api/products', function() {
    (new ProductController())->store();
});

// ✅ Update a product
Router::add('POST', '/api/products/{id}', function($id) {
    if (isset($_POST['_method']) && $_POST['_method'] === "PUT") {
        (new ProductController())->update($id);
    } else {
        echo json_encode(["error" => "Invalid Method"]);
    }
});


// ✅ Delete a product
Router::add('DELETE', '/api/products/{id}', function($id) {
    (new ProductController())->delete($id);
});




Router::dispatch();


}



