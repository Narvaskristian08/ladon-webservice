<?php

spl_autoload_register(function ($class) {

    $classPath = str_replace('\\', '/', $class);


    $fileApp = __DIR__ . "/app/Models/{$classPath}.php";
    if (file_exists($fileApp)) {
        require_once $fileApp;
        return;
    }

    $fileCore = __DIR__ . "/core/{$classPath}.php";
    if (file_exists($fileCore)) {
        require_once $fileCore;
        return;
    }
});
