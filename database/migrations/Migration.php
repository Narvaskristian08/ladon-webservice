<?php

require_once __DIR__ . '/../../core/Database.php';


class Migration {
    public static function start() {
        $db = Database::getInstance()->getConnection();

        try {
            // ✅ Create Database if not exists
            $db->exec("CREATE DATABASE IF NOT EXISTS ladon_service");
            $db->exec("USE ladon_service");

            // ✅ Create Users Table
            $db->exec("CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                level_type VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            echo "✅ Table 'users' created successfully!\n";


            // ✅ Create Products Table (Fixed `product_image` type)
            $db->exec("CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_image LONGBLOB, 
                product_name VARCHAR(255) NOT NULL,
                product_price INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            echo "✅ Table 'products' created successfully!\n";

            // ✅ Create History Table
            $db->exec("CREATE TABLE IF NOT EXISTS history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
            )");
            echo "✅ Table 'history' created successfully!\n";

            // ✅ Create Cart Table
            $db->exec("CREATE TABLE IF NOT EXISTS cart (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                quantity INT NOT NULL DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
            )");
            echo "✅ Table 'cart' created successfully!\n";

            // ✅ Create Favorites Table
            $db->exec("CREATE TABLE IF NOT EXISTS favorites (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
            )");
            echo "✅ Table 'favorites' created successfully!\n";

        } catch (PDOException $e) {
            die("❌ Migration failed: " . $e->getMessage());
        }
    }

    public static function reset() {
        $db = Database::getInstance()->getConnection();

        try {
            // ✅ Disable foreign key checks to avoid issues while deleting tables
            $db->exec("SET FOREIGN_KEY_CHECKS = 0");

            // ✅ Get all tables
            $stmt = $db->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // ✅ Drop each table
            foreach ($tables as $table) {
                $db->exec("DROP TABLE IF EXISTS $table");
                echo "🗑 Table '$table' deleted!\n";
            }

            // ✅ Enable foreign key checks after dropping tables
            $db->exec("SET FOREIGN_KEY_CHECKS = 1");

            // ✅ Run the migrations again
            self::start();

            echo "✅ Database reset and migrations re-applied!\n";

        } catch (PDOException $e) {
            die("Reset failed: " . $e->getMessage());
        }
    }
}
