<?php

require_once __DIR__ . '/../Models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // ✅ Handle user login
    public function login() {
        header('Content-Type: application/json');

        $inputData = json_decode(file_get_contents("php://input"), true);

        if (!isset($inputData['email']) || !isset($inputData['password'])) {
            echo json_encode(["error" => "Missing email or password"]);
            return;
        }

        $email = $inputData['email'];
        $password = $inputData['password'];

        $result = $this->userModel->loginUser($email, $password);

        echo json_encode($result);
    }

    // ✅ Handle user logout
    public function logout() {
        header('Content-Type: application/json');
        $result = $this->userModel->logoutUser();
        echo json_encode($result);
    }

    // ✅ Get total users
    public function totalUsers() {
        header('Content-Type: application/json');
        $result = $this->userModel->countUsers();
        echo json_encode($result);
    }

    // ✅ Delete a user
    public function deleteUser($id) {
        header('Content-Type: application/json');
        $result = $this->userModel->deleteUser($id);
        echo json_encode($result);
    }
}
