<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="inventory-dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="Group 12 24.png" alt="Ladon Logo">
            </div>
            <nav class="navbar">
                <ul class="nav-list">
                    <li class="nav-item"><Dashboard</li>
                    <li class="nav-item">Inventory Management</li>
                    <li class="nav-item">Order Processing</li>
                    <li class="nav-item">Sale Analytics</li>
                    <li class="nav-item">Marketing Tools</li>
                    <li class="nav-item">Customer Support</li>
                    <li class="nav-item">Settings</li>
                </ul>
            </nav>
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
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>!
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
</html>
