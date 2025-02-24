document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");
    const loginForm = document.getElementById("loginForm");

    // ✅ Register User
    document.getElementById("signupForm").addEventListener("submit", async function (event) {
        event.preventDefault();
    
        // Get input values
        const name = document.getElementById("signup-name").value;
        const email = document.getElementById("signup-email").value;
        const password = document.getElementById("signup-password").value;
        const contact = document.getElementById("signup-contact").value;
    
        // Validate all fields
        if (!name || !email || !password || !contact) {
            alert("Please fill in all fields.");
            return;
        }
    
        // Create request data
        const userData = {
            name: name,
            email: email,
            password: password,
            contact: contact
        };
    
        try {
            const response = await fetch("/api/register", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(userData)
            });
    
            const result = await response.json();
    
            if (response.ok) {
                alert(result.message);  // Show success message
                window.location.href = "/"; // Redirect after successful registration
            } else {
                alert(result.error);  // Show error message
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong. Please try again.");
        }
    });
    
    document.getElementById("loginForm").addEventListener("submit", async function(event) {
        event.preventDefault();
    
        const email = document.getElementById("login-email").value;
        const password = document.getElementById("login-password").value;
    
        const response = await fetch("http://localhost:8000/api/login", {
            method: "POST",
            mode: "cors", // Enable CORS
            credentials: "include", // Allow cookies (if needed)
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Origin": "*"
            },
            body: JSON.stringify({ email, password })
        });
    
        const result = await response.json();
        console.log(result);
    
        if (response.ok) {
            alert("Login successful!");
            window.location.href = response.redirected;
        } else {
            alert(result.error || "Login failed.");
        }
    });
});    