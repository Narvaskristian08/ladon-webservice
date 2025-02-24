<?php

require_once __DIR__ . '/../Models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

 
    public function register() {
        header('Content-Type: application/json');

        $inputData = json_decode(file_get_contents("php://input"), true);

        if (!isset($inputData['name'], $inputData['email'], $inputData['password'], $inputData['contact'])) {
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        $name = $inputData['name'];
        $email = $inputData['email'];
        $password = $inputData['password'];
        $contact = $inputData['contact'];
        $level_type = $inputData['level_type'] ?? 'user'; // Default to "user"

        $result = $this->userModel->createUser($name, $email, $password, $contact, $level_type);
        echo json_encode($result);
        exit;
    }

    // ✅ Login user
    public function login() {
        header('Content-Type: application/json');
        session_start();

        $inputData = json_decode(file_get_contents("php://input"), true);

        if (!isset($inputData['email'], $inputData['password'])) {
            echo json_encode(["error" => "Missing email or password"]);
            return;
        }

        $email = $inputData['email'];
        $password = $inputData['password'];
        $rememberMe = $inputData['remember_me'] ?? false;

        $result = $this->userModel->loginUser($email, $password, $rememberMe);

        if (isset($result['user'])) {
            echo json_encode([
                "message" => "Login successful",
                "user" => $result['user'],
                "redirect" => ($result['user']['level_type'] === 'admin') ? "/dashboard.php" : "/home.php"
            ]);
            exit;
            
        } else {
            echo json_encode(["error" => "Invalid email or password"]);
            exit;
        }
    }

    // Logout user
    public function logout() {
        header('Content-Type: application/json');
        session_start();
        session_destroy();

        //  Clear cookies
        setcookie("user_email", "", time() - 3600, "/");
        setcookie("auth_token", "", time() - 3600, "/");

        echo json_encode(["message" => "Logout successful"]);
        exit;
    }
}
