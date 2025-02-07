<?php
require_once __DIR__ . '/../autoload.php';

$db = Database::getInstance()->getConnection();

echo "Database connected successfully!";