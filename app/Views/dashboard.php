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
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/dashboard.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body>
<div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="/img/Group 12 24.png" alt="Ladon Logo">
            </div>
            <div id="sidebar-container"></div>
        </aside>

        <main class="content">
            <header class="header">
                <div class="icons">
                    <span class="bell">🔔</span>
                    <span class="profile">⚪</span>
                </div>
            </header>

            <section class="dashboard-content">
                <h1 class="dashboard-title">Welcome to your dashboard, 
                    <?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest'; ?>!
                </h1>
                <div class="stats">
                    <div class="card stat-card">
                        Total Users: <span id="totalUsers">Loading...</span>
                    </div>
                    <div class="card stat-card">Total Products: <span id="totalProducts">Loading...</span></div>
                </div>
                <div class="large-card pending-orders">Pending Orders</div>
            </section>
        </main>
</div>

<script src="/js/dashboard.js"></script>
<script src="/js/reusable.js"></script>
</body>
</html>
