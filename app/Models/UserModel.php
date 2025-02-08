<?php

require_once __DIR__ . '/../../core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Fetch all users
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new user
    public function createUser($name, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);
            return ["message" => "User created successfully"];
        } catch (PDOException $e) {
            return ["error" => "Error creating user: " . $e->getMessage()];
        }
    }

    // Fetch a user by ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user details
    public function updateUser($id, $name, $email) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':email' => $email
            ]);
            return ["message" => "User updated successfully"];
        } catch (PDOException $e) {
            return ["error" => "Error updating user: " . $e->getMessage()];
        }
    }

    // Delete a user
    public function deleteUser($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return ["message" => "User deleted successfully"];
        } catch (PDOException $e) {
            return ["error" => "Error deleting user: " . $e->getMessage()];
        }
    }
}
