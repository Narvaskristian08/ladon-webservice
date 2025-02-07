<?php

require_once __DIR__ . '/Database.php';

class Migration {
    public static function start() {
        $db = Database::getInstance()->getConnection();

        try {
        
            $db->exec("CREATE DATABASE IF NOT EXISTS ladon_service");
            $db->exec("USE ladon_service");
            $db->exec("CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            echo "error here ";

            // ✅ Create Passwords Table (Linked to Users)
            $db->exec("CREATE TABLE IF NOT EXISTS passwords (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                password_hash VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )");
            echo "error here";

           
            $db->exec("CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_name VARCHAR(255) NOT NULL,
                product_price INT NOT NULL
            )");
            echo "error here";

        } catch (PDOException $e) {
            die(" Migration failed: " . $e->getMessage());
        }
    }

    public static function reset() {
        $db = Database::getInstance()->getConnection();

        try {

            $db->exec("SET FOREIGN_KEY_CHECKS = 0");

            $stmt = $db->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        
            foreach ($tables as $table) {
                $db->exec("DROP TABLE IF EXISTS $table");
            }

            $db->exec("SET FOREIGN_KEY_CHECKS = 1");

            self::start();


        } catch (PDOException $e) {
            die("❌ Reset failed: " . $e->getMessage());
        }
    }
}
