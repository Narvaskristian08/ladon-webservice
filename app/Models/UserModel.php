<?php

require_once __DIR__ . '/../../core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ✅ Create a new user
    public function createUser($name, $email, $password, $level_type = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, level_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $level_type]);

        return ["message" => "User created successfully"];
    }

    // ✅ Get all users
    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, name, email, level_type, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Get total users count
    public function getTotalUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total_users FROM users");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function countUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM users");
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
    
    // ✅ Find user by email
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ User login
    public function loginUser($email, $password) {
        $user = $this->findUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Generate a simple session token (you can improve this with JWT)
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'level_type' => $user['level_type']
            ];
            return ["message" => "Login successful", "user" => $_SESSION['user']];
        } else {
            return ["error" => "Invalid email or password"];
        }
    }

    // ✅ User logout
    public function logoutUser() {
        session_destroy();
        return ["message" => "User logged out successfully"];
    }

    // ✅ Delete a user by ID
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return ["message" => "User deleted successfully"];
    }
}
