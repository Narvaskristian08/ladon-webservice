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

    // ✅ Get total users count
    public function getTotalUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total_users FROM users");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Find user by email
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ User login
public function loginUser($email, $password, $remember = false) {
    $user = $this->findUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
      
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'level_type' => $user['level_type']
        ];

        // ✅ If "Remember Me" is checked, store login token in a cookie
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('auth_token', $token, time() + (86400 * 30), "/"); // 30 days

            // Store token in database
            $stmt = $this->db->prepare("UPDATE users SET auth_token = ? WHERE id = ?");
            $stmt->execute([$token, $user['id']]);
        }

        return ["message" => "Login successful", "user" => $_SESSION['user']];
    } else {
        return ["error" => "Invalid email or password"];
    }
}

public function checkLogin() {
    session_start();

    if (isset($_SESSION['user'])) {
        return $_SESSION['user']; // User is logged in
    }

    // If session not found, check Remember Me token
    if (isset($_COOKIE['auth_token'])) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE auth_token = ?");
        $stmt->execute([$_COOKIE['auth_token']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'level_type' => $user['level_type']
            ];
            return $_SESSION['user'];
        }
    }

    return null; // Not logged in
}
public function logoutUser() {
    session_start();
    session_destroy();

    // Remove Remember Me cookie
    setcookie('auth_token', '', time() - 3600, "/");

    return ["message" => "User logged out successfully"];
}



    // ✅ Delete user by ID
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return ["message" => "User deleted successfully"];
    }
}
