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
        // ✅ Prevent multiple sessions
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $user = $this->findUserByEmail($email);
    
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'level_type' => $user['level_type']
            ];
    
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32));
                setcookie("user_email", $email, time() + (86400 * 30), "/");
                setcookie("auth_token", $token, time() + (86400 * 30), "/");
    
                $stmt = $this->db->prepare("UPDATE users SET auth_token = ? WHERE email = ?");
                $stmt->execute([$token, $email]);
            }
    
            return ["message" => "Login successful", "user" => $_SESSION['user']];
        } else {
            return ["error" => "Invalid email or password"];
        }
    }
    
    public function getTotalUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) as total_users FROM users WHERE level_type = 'user'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_users'] ?? 0;
    }
    
    
    
    
    // ✅ Check if the user is logged in
public function checkLogin() {
    session_start();

    if (isset($_SESSION['user'])) {
        return ["user" => $_SESSION['user']];
    }

    // ✅ Check Remember Me cookies
    if (isset($_COOKIE['user_email']) && isset($_COOKIE['auth_token'])) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND auth_token = ?");
        $stmt->execute([$_COOKIE['user_email'], $_COOKIE['auth_token']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'level_type' => $user['level_type']
            ];
            return ["user" => $_SESSION['user']];
        }
    }

    return ["error" => "Not logged in"];
}

}
