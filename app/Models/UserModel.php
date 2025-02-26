<?php

require_once __DIR__ . '/../../core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ✅ Create New User
    public function createUser($name, $email, $password, $contact, $level_type = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, contact, level_type, profile_image) VALUES (?, ?, ?, ?, ?, NULL)");
        $stmt->execute([$name, $email, $hashedPassword, $contact, $level_type]);

        return ["message" => "User registered successfully"];
    }

    // ✅ Find User by Email
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Login User
    public function loginUser($email, $password) {
        $user = $this->findUserByEmail($email);

        if (!$user) {
            return ["error" => "User not found. Please register first."];
        }

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'level_type' => $user['level_type'],
                'name' => $user['name']
                
            ];

            return ["message" => "Login successful", "redirect" => $user['level_type'] === 'admin' ? "/dashboard" : "/home"];
        } else {
            return ["error" => "Invalid email or password"];
        }
    }

    public function getTotalUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total_users FROM users WHERE level_type = 'user'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_users'] ?? 0;
    }
}
