<?php

require_once __DIR__ . '/../../core/Database.php';

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ✅ Get all products
    public function getAllProducts() {
        $stmt = $this->db->query("SELECT product_name,product_price, stock FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Add a new product
    public function addProduct($name, $price,$image,$stock) {
        $stmt = $this->db->prepare("INSERT INTO products (product_name, product_price,product_image,stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $price,$image,$stock]);
        return ["message" => "Product added successfully"];
    }

    // ✅ Delete a product by ID
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return ["message" => "Product deleted successfully"];
    }
}
