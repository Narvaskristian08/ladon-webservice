<?php
header("Content-Type: application/json"); // Ensure JSON responses
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';



Router::dispatch();
