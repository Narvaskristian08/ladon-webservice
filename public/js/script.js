document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("wrapper");
    const loginForm = document.querySelector(".login-container");
    const signupForm = document.querySelector(".signup-container");
    const showSignup = document.getElementById("showSignup");
    const showLogin = document.getElementById("showLogin");

    const passwordField = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const signupPasswordField = document.getElementById("signupPassword");
    const toggleSignupPassword = document.getElementById("toggleSignupPassword");

    function togglePasswordVisibility(inputField, icon) {
        if (inputField.type === "password") {
            inputField.type = "text";
            icon.src = "img/svg/Eye.svg";
        } else {
            inputField.type = "password";
            icon.src = "img/svg/Noeye.svg";
        }
    }

    togglePassword.addEventListener("click", function () {
        togglePasswordVisibility(passwordField, togglePassword);
    });

    toggleSignupPassword.addEventListener("click", function () {
        togglePasswordVisibility(signupPasswordField, toggleSignupPassword);
    });

    function swapForms() {
        loginForm.classList.add("hidden");
        signupForm.classList.add("hidden");

        setTimeout(() => {
            loginForm.classList.toggle("hidden");
            signupForm.classList.toggle("hidden");
        }, 200);
    }

    showSignup.addEventListener("click", function (e) {
        e.preventDefault();
        wrapper.classList.add("slide");
        swapForms();
    });

    showLogin.addEventListener("click", function (e) {
        e.preventDefault();
        wrapper.classList.remove("slide");
        swapForms();
    });
});
