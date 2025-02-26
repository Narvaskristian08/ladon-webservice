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

<?php include __DIR__ . '/../../public/reusable_component/navbar.php'; ?>

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
