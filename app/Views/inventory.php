<?php 
session_start();

//  Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /auth");
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
</head>

<body>
    <div class="inventory-dashboard">
    <aside class="sidebar">
            <div class="logo">
                <img src="/img/Group 12 24.png" alt="Ladon Logo">
            </div>
            <div id="sidebar-container"></div>
        </aside>


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
                        <button class="inventory-edit-btn">EDIT DETAILS</button>
                        <button class="inventory-delete-btn">DELETE</button>
                    </div>
                </div>

                <table class="inventory-table">
                    <thead class="inventory-thead">
                        <tr class="inventory-tr">
                            <th class="inventory-th"><input type="checkbox"></th>
                            <th class="inventory-th">NAME</th>
                            <th class="inventory-th">CATEGORY</th>
                            <th class="inventory-th">STOCK QUANTITY</th>
                            <th class="inventory-th">PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="inventory-tr">
                            <td class="inventory-td"><input type="checkbox"></td>
                            <td class="inventory-td">Sample Product</td>
                            <td class="inventory-td">Category A</td>
                            <td class="inventory-td">100</td>
                            <td class="inventory-td">$50.00</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
<script src="/js/reusable.js"></script>
</html>
