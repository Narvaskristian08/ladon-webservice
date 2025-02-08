<?php

require_once __DIR__ . '/../autoload.php'; // Autoload necessary files
require_once __DIR__ . '/../router.php';   // Load the routing system

// Dispatch Routes
Router::dispatch();
?>
