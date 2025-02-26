<?php

require_once __DIR__ . '/../Models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // ✅ Register User
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

    // ✅ Login User
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

        $result = $this->userModel->loginUser($email, $password);

        if (isset($result['error'])) {
            echo json_encode($result); // Send error message to frontend
        } else {
            echo json_encode(["message" => "Login successful!", "redirect" => $result['redirect']]);
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

        echo json_encode(["message" => "Logout successful", "redirect" => "/auth"]);
        exit;
    }
}
