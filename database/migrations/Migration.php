<?php

require_once __DIR__ . '/../../core/Database.php';

class Migration {
    public static function start() {
        $db = Database::getInstance()->getConnection();

        try {

            $db->exec("CREATE DATABASE IF NOT EXISTS ladon_service");
            $db->exec("USE ladon_service");


            $db->exec("CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                contact VARCHAR(20) NOT NULL, 
                level_type VARCHAR(255) NULL,
                auth_token VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");



            $db->exec("CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_image LONGBLOB, 
                product_name VARCHAR(255) NOT NULL,
                product_price INT NOT NULL,
                stock INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            echo " Table 'products' created successfully!\n";


            $db->exec("CREATE TABLE IF NOT EXISTS orders (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                total_price DECIMAL(10,2) NOT NULL,
                status ENUM('pending', 'paid', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )");
            echo " Table 'orders' created successfully!\n";


            $db->exec("CREATE TABLE IF NOT EXISTS order_items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                order_id INT NOT NULL,
                product_id INT NOT NULL,
                quantity INT NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )");
            echo " Table 'order_items' created successfully!\n";

           
            $db->exec("CREATE TABLE IF NOT EXISTS payments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                order_id INT NOT NULL,
                amount DECIMAL(10,2) NOT NULL,
                payment_method ENUM('gcash', 'credit_card', 'bank_transfer') NOT NULL,
                transaction_id VARCHAR(255) NOT NULL UNIQUE, 
                status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
            )");
            echo " Table 'payments' created successfully!\n";

       
            $db->exec("CREATE TABLE IF NOT EXISTS history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )");
            echo "✅ Table 'history' created successfully!\n";

     
            $db->exec("CREATE TABLE IF NOT EXISTS cart (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                quantity INT NOT NULL DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )");
            echo " Table 'cart' created successfully!\n";

            $db->exec("CREATE TABLE IF NOT EXISTS favorites (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            )");
            echo " Table 'favorites' created successfully!\n";

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
                echo "🗑 Table '$table' deleted!\n";
            }
            $db->exec("SET FOREIGN_KEY_CHECKS = 1");

            self::start();
            echo " Database reset and migrations re-applied!\n";

        } catch (PDOException $e) {
            die("Reset failed: " . $e->getMessage());
        }
    }
}
?>
