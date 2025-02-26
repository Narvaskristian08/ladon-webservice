<?php 
session_start();
//  Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /auth");
    exit();
}

//  Redirect if not admin
if ($_SESSION['user']['level_type'] !== 'admin') {
    header("Location: /home");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/inv.css">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
    <div class="inventory-dashboard">
    <?php include __DIR__ . '/../../public/reusable_component/sidebar.php'; ?>

        <main class="inventory-content">
            <header class="inventory-header">
                <div class="inventory-icons">
                    <span class="inventory-bell">🔔</span>
                    <span class="inventory-profile">⚪</span>
                </div>
            </header>

            <section class="inventory-dashboard-content">
                <h1 class="inventory-title">Welcome to your inventory dashboard, 
                <?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest'; ?>!
                </h1>

                <div class="inventory-actions">
                    <input class="inventory-search" type="text" placeholder="Search..">
                    <div class="action-btn">
                        <button class="inventory-add-btn">ADD PRODUCTS</button>
                        <button class="inventory-edit-btn">EDIT DETAILS</button><!-- i already have this as edit buttom-->
                        <button class="inventory-delete-btn">DELETE</button><!-- i already have this delete button -->
                    </div>
                </div>

                <table class="inventory-table">
                    <thead class="inventory-thead">
                        <tr class="inventory-tr">
                            <th class="inventory-th"><input type="checkbox"></th>
                            <th class="inventory-th">NAME</th>
                            <th class="inventory-th">CATEGORY</th>
                            <th class="inventory-th">STOCK</th>
                            <th class="inventory-th">PRICE</th>
                            <th class="inventory-th">IMAGE</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- ✅ Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Add Product</h2>

            <form id="productForm">
                <input type="hidden" id="productId"> <!-- Hidden ID for Editing -->

                <label for="productName">Product Name:</label>
                <input type="text" id="productName" required>

                <label for="productCategory">Category:</label>
                <input type="text" id="productCategory" required>

                <label for="productStock">Stock Quantity:</label>
                <input type="number" id="productStock" required>

                <label for="productPrice">Price:</label>
                <input type="number" id="productPrice" required>

                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage">

                <button type="submit">Save Product</button>
            </form>
        </div>
    </div>

</body>
<script src="/js/inventory.js"></script>
<script src="/js/modal.js"></script>
<script src="/js/auth.js"></script>
</html>
