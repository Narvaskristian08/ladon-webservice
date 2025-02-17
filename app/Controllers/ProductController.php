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
        echo json_encode($this->productModel->getAllProducts());
    }

    // ✅ Add a new product
    public function store() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['product_name'], $data['product_price'])) {
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        echo json_encode($this->productModel->addProduct($data['product_name'], $data['product_price'],$data['product_image'], $data['stock']));
    }

    // ✅ Delete product
    public function delete($id) {
        header('Content-Type: application/json');
        echo json_encode($this->productModel->deleteProduct($id));
    }
}
