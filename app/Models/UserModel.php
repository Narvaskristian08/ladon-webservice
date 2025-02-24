<?php

require_once __DIR__ . '/../../core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ✅ Create a new user
    public function createUser($name, $email, $password, $contact, $level_type = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, contact, level_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $contact, $level_type]);

        return ["message" => "User registered successfully"];
    }

    // ✅ Find user by email
    public function findUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ User Login with "Remember Me"
    public function loginUser($email, $password, $rememberMe = false) {
        $user = $this->findUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();

            // ✅ Store user session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'level_type' => $user['level_type']
            ];

            // ✅ If "Remember Me" is checked, store in cookies
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32)); // Generate secure token
                setcookie("user_email", $email, time() + (86400 * 30), "/"); // 30 days
                setcookie("auth_token", $token, time() + (86400 * 30), "/");

                // ✅ Save token in DB for validation
                $stmt = $this->db->prepare("UPDATE users SET auth_token = ? WHERE email = ?");
                $stmt->execute([$token, $email]);
            }

            return ["message" => "Login successful", "user" => $_SESSION['user']];
        } else {
            return ["error" => "Invalid email or password"];
        }
    }
}
