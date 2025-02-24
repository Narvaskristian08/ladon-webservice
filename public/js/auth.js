document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");
    const loginForm = document.getElementById("loginForm");
    const logoutBtn = document.getElementById("logoutBtn"); // ✅ Logout Button

    // ✅ Register User
    if (signupForm) {
        signupForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            const name = document.getElementById("signup-name").value;
            const email = document.getElementById("signup-email").value;
            const password = document.getElementById("signup-password").value;
            const contact = document.getElementById("signup-contact").value;

            if (!name || !email || !password || !contact) {
                alert("Please fill in all fields.");
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
                    window.location.href = "/auth"; 
                } else {
                    alert(result.error || "Registration failed.");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Something went wrong. Please try again.");
            }
        });
    }

    // ✅ Login User
    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            const email = document.getElementById("login-email").value;
            const password = document.getElementById("login-password").value;

            try {
                const response = await fetch("http://localhost:8000/api/login", {
                    method: "POST",
                    credentials: "include",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ email, password })
                });

                const text = await response.text();
                console.log("Raw API Response:", text);

                const jsonStart = text.indexOf("{");
                const jsonText = text.substring(jsonStart).trim();
                const result = JSON.parse(jsonText);

                if (response.ok) {
                    alert("Login successful!");
                    window.location.href = result.redirect;
                } else {
                    alert(result.error || "Login failed.");
                }
            } catch (error) {
                console.error("Fetch Error:", error);
                alert("Something went wrong.");
            }
        });
    }
});
