<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="img/svg/Group 12 24.png" alt="Ladon Logo">
            </div>
            <nav class="navbar">
                <ul class="nav-list">
                    <li class="nav-item">Dashboard</li>
                    <li class="nav-item">Inventory Management</li>
                    <li class="nav-item">Order Processing</li>
                    <li class="nav-item">Sale Analytics</li>
                    <li class="nav-item">Marketing Tools</li>
                    <li class="nav-item">Customer Support</li>
                    <li class="nav-item">Settings</li>
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
