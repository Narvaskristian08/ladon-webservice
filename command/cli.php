<?php

require_once __DIR__ . '/../database/migrations/Migration.php';
require_once __DIR__ . '/../app/Models/UserModel.php';

// Run the migration script
if ($argc > 1){
    $cast = $argv[1];

    if ($cast === 'deb:start') {
        Migration::start();
        echo "✅ Backend Started\n";
    } 
    elseif ($cast === 'deb:reset') {
        Migration::reset();
        echo "✅ Backend Restarted\n";
    } 
    elseif ($cast === 'deb:help') {
        echo "Available Commands:\n";
        echo "deb:start → Start the backend and run migrations\n";
        echo "deb:reset → Reset the database and rerun migrations\n";
        echo "deb:add-admin {name} {email} {password} → Add an admin user\n";
    } 
    elseif ($cast == 'server:start'){
        exec("php -S localhost:8000 -t public");
    }
    elseif ($cast === 'deb:add-admin') {
        if ($argc < 5) {
            echo "Error: Missing required parameters.\n";
            echo "Usage: php command/cli.php deb:add-admin {name} {email} {password}\n";
            exit;
        }

        $name = $argv[2];
        $email = $argv[3];
        $password = $argv[4];

        $userModel = new UserModel();
        $result = $userModel->createUser($name, $email, $password ,$contact , 'admin');

        echo json_encode($result);
    } 
    else {
        echo "Invalid command! Use 'deb:help' for help.\n";
    }
}
