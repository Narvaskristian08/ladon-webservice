document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");
    const loginForm = document.getElementById("loginForm");
    document.getElementById("signupForm").addEventListener("submit", async function(event) {
        event.preventDefault();
    
        // Get input values
        const name = document.getElementById("signup-name").value;
        const email = document.getElementById("signup-email").value;
        const password = document.getElementById("signup-password").value;
        const contact = document.getElementById("signup-contact").value;
    
        // Validate fields
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
                window.location.href = "/auth"; // Redirect after successful registration
            } else {
                alert(result.error || "Registration failed.");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong. Please try again.");
        }
    });
    
    document.getElementById("loginForm").addEventListener("submit", async function (event) {
        event.preventDefault();
    
        const email = document.getElementById("login-email").value;
        const password = document.getElementById("login-password").value;
    
        try {
            const response = await fetch("http://localhost:8000/api/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email, password })
            });
    
            const result = await response.json();
            console.log(result); // ✅ Debugging: See if redirect is returned
    
            if (response.ok) {
                alert("Login successful!");
                window.location.href = result.redirect;  // ✅ Redirect to correct page
            } else {
                alert(result.error || "Login failed.");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong.");
        }
    });    
});    