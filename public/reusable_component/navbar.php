<?php
session_start();

// Check if user is logged in
$user = $_SESSION['user'] ?? null;
$profileName = $user['name'] ?? 'Guest';
$profileImage = $user['profile_image'] ?? '/img/placeholder.jpg'; // Default profile image
?>

<nav class="home-header">
    <div class="home-header-logo">
        <img src="img/Group 12 24.png">
    </div>
    <div class="home-header-items">
        <img src="img/Home (1).png">
        <img src="img/Home.png">
        <img src="img/Home (1).png">
        <a href="/settings">
            <div class="home-profile">
                <p1><?php echo htmlspecialchars($profileName); ?></p1>
                <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture">
            </div>
        </a>
    </div>
</nav>
