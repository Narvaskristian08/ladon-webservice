<?php
require_once __DIR__ . '/../Models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Fetch all users
    public function index() {
        header('Content-Type: application/json');
        $users = $this->userModel->getAllUsers();
        echo json_encode($users);
    }

    // Store a new user
    public function store() {
        header('Content-Type: application/json');

        // Get JSON input
        $inputData = json_decode(file_get_contents("php://input"), true);

        if (!isset($inputData['name']) || !isset($inputData['email']) || !isset($inputData['password'])) {
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        $name = $inputData['name'];
        $email = $inputData['email'];
        $password = $inputData['password'];

        $result = $this->userModel->createUser($name, $email, $password);

        echo json_encode($result);
    }

    // Fetch a single user by ID
    public function show($id) {
        header('Content-Type: application/json');
        $user = $this->userModel->getUserById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
    }

    // Update user details
    public function update($id) {
        header('Content-Type: application/json');

        $inputData = json_decode(file_get_contents("php://input"), true);
        if (!isset($inputData['name']) || !isset($inputData['email'])) {
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        $result = $this->userModel->updateUser($id, $inputData['name'], $inputData['email']);
        echo json_encode($result);
    }

    // Delete a user
    public function delete($id) {
        header('Content-Type: application/json');

        $result = $this->userModel->deleteUser($id);
        echo json_encode($result);
    }
}
