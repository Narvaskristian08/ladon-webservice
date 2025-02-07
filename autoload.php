<?php

spl_autoload_register(function ($class) {
    // Convert namespace separator (\) to directory separator (/)
    $classPath = str_replace('\\', '/', $class);

    // Check in app/ directory
    $fileApp = __DIR__ . "/app/Models/{$classPath}.php";
    if (file_exists($fileApp)) {
        require_once $fileApp;
        return;
    }

    // Check in core/ directory
    $fileCore = __DIR__ . "/core/{$classPath}.php";
    if (file_exists($fileCore)) {
        require_once $fileCore;
        return;
    }
});
