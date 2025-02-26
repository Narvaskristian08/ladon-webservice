<?php

require_once __DIR__ . '/../Models/ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    // ✅ Get all products
    public function index() {
        header('Content-Type: application/json');
        try {
            $products = $this->productModel->getAllProducts();
            echo json_encode($products);
            exit;
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
            exit;
        }
    }

    // ✅ Get a single product
    public function show($id) {
        header('Content-Type: application/json');
        if (!is_numeric($id)) {
            echo json_encode(["error" => "Invalid product ID"]);
            exit;
        }
        $product = $this->productModel->getProductById($id);
        echo json_encode($product ?: ["error" => "Product not found"]);
        exit;
    }

    // ✅ Add product
    public function store() {
        header('Content-Type: application/json');
    
        try {
            if (!isset($_POST['product_name'], $_POST['stock'], $_POST['product_price'])) {
                echo json_encode(["error" => "Missing required fields"]);
                exit; // ✅ Prevent multiple responses
            }
    
            $productName = $_POST['product_name'];
            $productCategory = $_POST['product_category'] ?? "N/A";
            $stock = $_POST['stock'];
            $productPrice = $_POST['product_price'];
            $productImage = null;
    
            // ✅ Handle Image Upload
            if (!empty($_FILES['product_image']['tmp_name'])) {
                $imageData = file_get_contents($_FILES['product_image']['tmp_name']);
                $productImage = base64_encode($imageData); // Convert image to Base64
            }
    
            $result = $this->productModel->addProduct($productName, $productCategory, $stock, $productPrice, $productImage);
    
            if ($result) {
                echo json_encode(["message" => "Product added successfully"]);
            } else {
                echo json_encode(["error" => "Failed to add product"]);
            }
            exit; // ✅ Prevent multiple responses
        } catch (Exception $e) {
            echo json_encode(["error" => "Server error: " . $e->getMessage()]);
            exit;
        }
    }
    

    // ✅ Update product
    public function update($id) {
        header('Content-Type: application/json');
    
        error_log("🛠 Incoming PUT Request for ID: $id");
    
        if (isset($_POST['_method']) && $_POST['_method'] === "PUT") {
            $_PUT = $_POST;
        } else {
            parse_str(file_get_contents("php://input"), $_PUT);
        }
    
        error_log("📩 Received Data: " . json_encode($_PUT));
    
        if (!isset($_PUT['product_name'], $_PUT['stock'], $_PUT['product_price'])) {
            echo json_encode(["error" => "❌ Missing required fields"]);
            return;
        }
    
        $productName = $_PUT['product_name'];
        $productCategory = $_PUT['product_category'] ?? "N/A";
        $stock = $_PUT['stock'];
        $productPrice = $_PUT['product_price'];
        $productImage = null;
    
        if (!empty($_FILES['product_image']['tmp_name'])) {
            $imageData = file_get_contents($_FILES['product_image']['tmp_name']);
            $productImage = base64_encode($imageData);
        }
    
        $result = $this->productModel->updateProduct($id, $productName, $productCategory, $stock, $productPrice, $productImage);
    
        if ($result) {
            echo json_encode(["message" => "✅ Product updated successfully"]);
            exit;
        } else {
            echo json_encode(["error" => "❌ Failed to update product"]);
        }
    }
    
    
    
    
    

    // ✅ Delete product
    public function delete($id) {
        header('Content-Type: application/json');
        if (!is_numeric($id)) {
            echo json_encode(["error" => "Invalid product ID"]);
            return;
        }
        $success = $this->productModel->deleteProduct($id);
        echo json_encode($success ? ["message" => "Product deleted successfully"] : ["error" => "Product not found"]);
        exit;
    }
}
