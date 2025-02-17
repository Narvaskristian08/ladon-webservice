<?php

require_once __DIR__ . '/../Models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // ✅ Register a new user
    public function register() {
        header('Content-Type: application/json');

        $inputData = json_decode(file_get_contents("php://input"), true);

        if (!isset($inputData['name'], $inputData['email'], $inputData['password'])) {
            echo json_encode(["error" => "Missing name, email, or password"]);
            return;
        }

        $name = $inputData['name'];
        $email = $inputData['email'];
        $password = $inputData['password'];
        $level_type = $inputData['level_type'] ?? 'user'; // Default to "user"

        $result = $this->userModel->createUser($name, $email, $password, $level_type);
        echo json_encode($result);
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
            if ($result['user']['level_type'] === 'admin') {
                echo json_encode(["message" => "Login successful", "redirect" => "/admin/dashboard.php"]);
            } else {
                echo json_encode(["message" => "Login successful", "redirect" => "/dashboard.php"]);
            }
        } else {
            echo json_encode(["error" => "Invalid email or password"]);
        }
    }

    // ✅ Logout user
    public function logout() {
        header('Content-Type: application/json');
        session_start();

        // ✅ Clear session and cookies
        session_destroy();
        setcookie("user_email", "", time() - 3600, "/");
        setcookie("user_token", "", time() - 3600, "/");

        echo json_encode(["message" => "Logout successful"]);
    }

    // ✅ Get total users count
    public function totalUsers() {
        header('Content-Type: application/json');
        $totalUsers = $this->userModel->getTotalUsers();
        echo json_encode($totalUsers);
    }

    // ✅ Delete user
    public function deleteUser($id) {
        header('Content-Type: application/json');

        $result = $this->userModel->deleteUser($id);
        echo json_encode($result);
    }
}
