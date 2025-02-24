<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ladon</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
<div class="wrapper" id="wrapper">
   
    <div class="img-container">
        <img src="/img/Rectangle 2225.png" alt="Books & Study Theme">
    </div>

<!--LOGINNNNNNNNNNNN-->
    <div class="form-container login-container">
        <div class="login-logo">
            <img src="/img/Group 12 24.png" alt="Ladon Logo">
        </div>
        <h2 class="login-heading">Welcome to Ladon</h2>
        <p class="login-paragraph">Please enter your registered email and password to login.</p>

        <form id="loginForm">
            <div class="login-input-container">
                <label class="login-input-label" for="login-email">Email</label>
                <div class="login-input-group">
                    <img src="/img/svg/Email.svg" class="login-input-icon" alt="Email">
                    <input type="email" placeholder="Enter your email" id="login-email" required>
                </div>
            </div>

            <div class="login-input-container">
                <label class="login-input-label" for="login-password">Password</label>
                <div class="login-input-group">
                    <img src="/img/svg/Password.svg" class="login-input-icon" alt="Password">
                    <input type="password" id="login-password" placeholder="Enter your password" required>
                    <img src="img/svg/Noeye.svg" class="toggle-password" id="togglePassword" alt="Toggle Password">
                </div>
            </div>

            <a href="#" class="forgot-password">Forgot your password?</a>
            <button type="submit" class="login-btn">LOGIN</button>
            <p class="or-text">or</p>
            <div class="login-social-login">
                <a href="#" class="login-social-btn"><img src="/img/Facebook.png" alt="Facebook"></a>
                <a href="#" class="login-social-btn"><img src="/img/Google.png" alt="Google"></a>
            </div>
        </form>

        <p class="login-text">Don't have an account? <a href="#" id="showSignup">Signup</a></p>
    </div>

<!--SIGNNNNUPPPPPPPPPP-->
    <div class="form-container signup-container hidden">
        <div class="signup-logo">
            <img src="/img/Group 12 24.png" alt="Ladon Logo">
        </div>
        <h2 class="signup-heading">Create your own account for free!</h2>
        <p class="signup-paragraph">Please fill all the fields and create your own password.</p>

        <form id="signupForm">
            <div class="signup-input-container">
                <label class="signup-input-label" for="signup-name">UserName</label>
                <div class="signup-input-group">
                    <img src="/img/svg/user.svg" class="signup-input-icon" alt="Username">
                    <input type="text" id="signup-name" placeholder="Enter your name" required>
                </div>
            </div>

            <div class="signup-input-container">
                <label class="signup-input-label" for="signup-email">Email</label>
                <div class="signup-input-group">
                    <img src="/img/svg/Email.svg" class="signup-input-icon" alt="Email">
                    <input type="email" id="signup-email" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="signup-input-container">
                <label class="signup-input-label" for="signup-password">Password</label>
                <div class="signup-input-group">
                    <img src="/img/svg/Password.svg" class="signup-input-icon" alt="Password">
                    <input type="password" id="signup-password" placeholder="Create your password" required>
                    <img src="img/svg/Noeye.svg" class="toggle-password" id="toggleSignupPassword" alt="Toggle Password">
                </div>
            </div>

            <div class="signup-input-container">
        <label class="signup-input-label" for="signup-contact">Contact</label>
        <div class="signup-input-group">
            <img src="/img/svg/Contact.svg" class="signup-input-icon" alt="Contact">
            <input type="text" id="signup-contact" placeholder="Enter your contact number" required> 
        </div>
    </div>

            <button type="submit" class="signup-btn">SIGNUP</button>
            <p class="or-text">or</p>
            <div class="signup-social-login">
                <a href="#" class="signup-social-btn"><img src="/img/Facebook.png" alt="Facebook"></a>
                <a href="#" class="signup-social-btn"><img src="/img/Google.png" alt="Google"></a>
            </div>
        </form>

        <p class="signup-text">Already have an account? <a href="#" id="showLogin">Login</a></p>
    </div>
</div>

<script src="/js/auth.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
