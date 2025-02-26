<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/set-ad.css">
</head>
<body>
<div class="set-admin">

<?php include __DIR__ . '/../../public/reusable_component/sidebar.php'; ?>
    <main class="content">
    
        <header class="header">
                    <div class="icons">
                        <span class="bell">🔔</span>
                        <span class="profile">⚪</span>
                    </div>
        </header>
        
        <div class="settings-container">
    <h2><u>Account Setting</u></h2>
    
    <div class="settings-form">

        <form class="profile-upload" action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="profile-pic" class="profile-picture">
                <span>Upload your photo</span>
            </label>
            <input type="file" id="profile-pic" name="profile-pic" accept="image/*" style="display: none;">
    
        </form>

        <!-- Input Fields -->
        <div class="input-fields">
            <div class="input-group">
                <label>Full Name:</label>
                <input type="text" placeholder="Please enter your full name">
            </div>

            <div class="input-group">
                <label>Email:</label>
                <input type="email" placeholder="Please enter your email">
            </div>

            <div class="input-group">
                <label>Username:</label>
                <input type="text" placeholder="Please enter your username">
            </div>

            <div class="input-group">
                <label>Phone Number:</label>
                <input type="tel" placeholder="Please enter your phone number">
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="button-group">
        <button class="update-btn">Update Profile</button>
        <button class="reset-btn">Reset</button>
    </div>
</div>


    </main>
</body>
</html>