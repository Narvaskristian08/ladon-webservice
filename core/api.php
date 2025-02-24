<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header("Content-Type: application/json"); // ✅ Ensure JSON response
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Prevents HTML/extra characters from interfering
ob_start();


require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../router.php';

Router::dispatch();
