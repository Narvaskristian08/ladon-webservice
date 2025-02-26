document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");
    const loginForm = document.getElementById("loginForm");
    const logoutBtn = document.getElementById("logoutBtn");

    // ✅ Register User with Confirm Password Validation
    if (signupForm) {
        signupForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            const name = document.getElementById("signup-name").value.trim();
            const email = document.getElementById("signup-email").value.trim();
            const password = document.getElementById("signup-password").value.trim();
            const confirmPassword = document.getElementById("signup-confirm-password").value.trim();
            const contact = document.getElementById("signup-contact").value.trim();

            // ✅ Confirm Password Validation
            if (password !== confirmPassword) {
                alert("❌ Passwords do not match!");
                return;
            }

            // ✅ Basic Input Validation
            if (!name || !email || !password || !confirmPassword || !contact) {
                alert("❌ Please fill in all fields.");
                return;
            }

            try {
                const response = await fetch("http://localhost:8000/api/register", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ name, email, password, contact })
                });

                const result = await response.json();

                if (response.ok) {
                    alert(result.message);
                    window.location.href = "/auth"; // Redirect to login page
                } else {
                    alert(result.error || "❌ Registration failed.");
                }
            } catch (error) {
                console.error("❌ Error:", error);
                alert("Something went wrong. Please try again.");
            }
        });
    }

    // ✅ Login User
    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            const email = document.getElementById("login-email").value.trim();
            const password = document.getElementById("login-password").value.trim();

            try {
                const response = await fetch("http://localhost:8000/api/login", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ email, password })
                });

                const result = await response.json();

                if (response.ok && result.redirect) {
                    alert("✅ Login successful!");
                    window.location.href = result.redirect; // Redirect user based on role
                } else {
                    alert(result.error || "❌ Login failed.");
                }
            } catch (error) {
                console.error("❌ Error:", error);
                alert("Something went wrong. Please try again.");
            }
        });
    }

    // ✅ Logout User
    if (logoutBtn) {
        logoutBtn.addEventListener("click", async function (event) {
            event.preventDefault(); // Prevents default link behavior

            try {
                const response = await fetch("http://localhost:8000/api/logout", {
                    method: "POST",
                    credentials: "include",
                    headers: { "Content-Type": "application/json" }
                });

                const result = await response.json();
                console.log("Logout API Response:", result);

                if (response.ok) {
                    alert(result.message);
                    window.location.href = "/auth"; // Redirect to login page
                } else {
                    alert("Logout failed.");
                }
            } catch (error) {
                console.error("Logout Error:", error);
                alert("Something went wrong. Try again.");
            }
        });
    }
});
