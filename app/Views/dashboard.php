<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="/img/Group 12 24.png" alt="Ladon Logo">
            </div>
            <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-item"><a href="http://localhost:8000/dashboard">Dashboard</a></li>
                <li class="nav-item"><a href="http://localhost:8000/inventory">Inventory Management</a></li>
                <li class="nav-item"><a href="orders.php">Order Processing</a></li>
                <li class="nav-item"><a href="analytics.php">Sale Analytics</a></li>
                <li class="nav-item"><a href="marketing.php">Marketing Tools</a></li>
                <li class="nav-item"><a href="support.php">Customer Support</a></li>
                <li class="nav-item"><a href="settings.php">Settings</a></li>
            </ul>

            </nav>
        </aside>
        <main class="content">
            <header class="header">
                <div class="icons">
                    <span class="bell">🔔</span>
                    <span class="profile">⚪</span>
                </div>
            </header>
            <section class="dashboard-content">
                <h1 class="dashboard-title">Welcome to your dashboard, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>!</h1>
                <div class="stats">
                    <div class="card stat-card">Total Orders</div>
                    <div class="card stat-card">Revenue Today</div>
                </div>
                <div class="large-card pending-orders">Pending Orders</div>
            </section>
        </main>
    </div>
</body>
</html>
