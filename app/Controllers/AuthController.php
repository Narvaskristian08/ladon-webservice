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
    public function totalUsers() {
        header('Content-Type: application/json');
        $totalUsers = $this->userModel->getTotalUsers();
        echo json_encode(["total_users" => $totalUsers]);
        exit;
    }

    

    // ✅ Login user
    public function login() {
        header('Content-Type: application/json');
    
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $inputData = json_decode(file_get_contents("php://input"), true);
    
        if (!isset($inputData['email'], $inputData['password'])) {
            echo json_encode(["error" => "Missing email or password"]);
            return;
        }
    
        $email = $inputData['email'];
        $password = $inputData['password'];
    
        $user = $this->userModel->findUserByEmail($email);
    
        if ($user && password_verify($password, $user['password'])) {
            // ✅ Ensure "name" is included in the session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'], 
                'email' => $user['email'],
                'level_type' => $user['level_type']
            ];
    
            echo json_encode(["message" => "Login successful", "redirect" => "/dashboard"]);
            exit;
        } else {
            echo json_encode(["error" => "Invalid email or password"]);
            exit;
        }
    }
    
    
    
      
    public function logout() {
        header('Content-Type: application/json');
        session_start();
    
        // ✅ Clear session
        $_SESSION = [];
        session_unset();
        session_destroy();
    
        // ✅ Clear cookies
        setcookie("user_email", "", time() - 3600, "/");
        setcookie("auth_token", "", time() - 3600, "/");
    
        echo json_encode(["message" => "Logout successful", "redirect" => "/auth"]);
        exit;
    }
    
    
    
}
