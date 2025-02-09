<?php

require_once __DIR__ . '/../../core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createUser($name, $email, $password, $level_type = 'user') {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->db->prepare("INSERT INTO users (name, email, password, level_type) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword, $level_type]);

            return ["success" => true, "message" => "User created successfully", "level" => $level_type];
        } catch (PDOException $e) {
            return ["error" => "Failed to create user: " . $e->getMessage()];
        }
    }

    public function loginUser($email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT id, name, email, password, level_type FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_level'] = $user['level_type'];

                return ["success" => true, "message" => "Login successful", "user" => $user];
            }

            return ["error" => "Invalid email or password"];
        } catch (PDOException $e) {
            return ["error" => "Login failed: " . $e->getMessage()];
        }
    }

    public function logoutUser() {
        session_start();
        session_destroy();
        return ["success" => true, "message" => "Logged out successfully"];
    }
}
