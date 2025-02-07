<?php

function env($key, $default = null) {
    static $env = null;

    if ($env === null) {
        $env = parse_ini_file(__DIR__ . '/.env');
    }

    return $env[$key] ?? $default;
}

return [
    'db' => [
        'host' => env('DB_HOST', 'localhost'),
        'name' => env('DB_NAME', 'ladon-service'),
        'user' => env('DB_USER', 'root'),
        'pass' => env('DB_PASS', 'root'),
    ]
];