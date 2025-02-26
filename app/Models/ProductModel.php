<?php

require_once __DIR__ . '/../../core/Database.php';

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ✅ Get all products
    public function getAllProducts() {
        try {
            $stmt = $this->db->query("SELECT id, product_name, product_category, stock, product_price, product_image, created_at FROM products");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Database fetch error");
        }
    }

    // ✅ Get product by ID
    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Add product
    public function addProduct($name, $category, $stock, $price, $image = null) {
        $stmt = $this->db->prepare("INSERT INTO products (product_name, product_category, stock, product_price, product_image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $category, $stock, $price, $image]);
    }

    // ✅ Update product
    public function updateProduct($id, $name, $category, $stock, $price, $image = null) {
        if ($image) {
            $stmt = $this->db->prepare("UPDATE products SET product_name = ?, product_category = ?, stock = ?, product_price = ?, product_image = ? WHERE id = ?");
            return $stmt->execute([$name, $category, $stock, $price, $image, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE products SET product_name = ?, product_category = ?, stock = ?, product_price = ? WHERE id = ?");
            return $stmt->execute([$name, $category, $stock, $price, $id]);
        }
    }
    
    public function getTotalProduct() {
        $stmt = $this->db->query("SELECT COUNT(*) as total_product FROM products");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_product'] ?? 0;
    }
    
    

    // ✅ Delete product
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
