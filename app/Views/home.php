<?php
session_start();

// Check if user is logged in
$user = $_SESSION['user'] ?? null;
$profileName = $user['name'] ?? 'Guest';
$profileImage = $user['profile_image'] ?? '/img/placeholder.jpg'; // Default profile image
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
</head>
<body class="home">
    <nav class="home-header">
        <div class="home-header-logo">
            <img src="img/Group 12 24.png">
        </div>
        <div class="home-header-items">
            <img src="img/Home (1).png">
            <img src="img/Home.png">
            <img src="img/Home (1).png">
            <div class="home-profile">
                <a href="/settings"><?php echo htmlspecialchars($profileName); ?></a>
                <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture">
            </div>
        </div>
    </nav>

    <div class="home-body">
        <div class="home-cont">
            <div class="home-hero">
                <div class="hero-pic"></div>
            </div>
            <div class="home-cat">
                <button class="cat-btn">All</button>
                <button class="cat-btn"><img src="img/Letter.png">NoterBook</button>
                <button class="cat-btn">Ballpen</button>
                <button class="cat-btn">Pencil</button>
                <button class="cat-btn">Ruler</button>
                <button class="cat-btn">Marker</button>
            </div>

            <div class="home-items"></div>

            <footer class="footer">
                <div class="foot-cont">
                    <div class="foot">
                        <b>My Account</b>
                        <a href="">Shopping Cart</a>
                        <a href="">Check Out</a>
                    </div>
                    <div class="foot">
                        <b>INFORMATION</b>
                        <a href="">About Us</a>
                        <a href="">Contact Us</a>
                        <a href="">FAQ</a>
                        <a href="">Terms of Service</a>
                    </div>
                    <div class="foot">
                        <b>POLICIES</b>
                        <a href="">Privacy Policy</a>
                        <a href="">Shipping Policy</a>
                    </div>
                    <div class="foot">
                        <img src="img/Group 12 24.png">
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
