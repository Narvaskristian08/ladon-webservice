<?php

require_once __DIR__ . '/../core/Migration.php';

// Run the migration script
if ($argc > 1){
    $cast=$argv[1];
    if ($cast === 'deb:start')
    {
        Migration::start();
        echo "Backend Start";
    }
    elseif ($cast === 'deb:reset')
    {
        Migration::reset();
        echo "Backened Restarted";
    }
    elseif ($cast=== 'deb:help'){
        echo "deb:start for integrating and starting backend \n";
        echo "deb:reset for resetting the backend";

    }
    elseif ($cast === 'server:start') {
        echo "Starting PHP development server at http://localhost:8000...\n";
        exec("php -S localhost:8000 -t public");
    }

    else{
    echo "Incorrect command use deb:help for help command";
    };


}





