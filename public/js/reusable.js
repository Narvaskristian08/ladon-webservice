
document.addEventListener("DOMContentLoaded", function () {
    sidebar();
});

function sidebar(){
    fetch("/reusable-component/sidebar.html")
        .then(response => response.text())
        .then(html => {
            document.getElementById("sidebar-container").innerHTML = html;
            Logout();
        })
        .catch(error => console.error("Error loading navbar:", error));
}
function Logout() {
    const logoutBtn = document.getElementById("logoutBtn");

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
                window.location.href = "/auth"; // ✅ Redirect to login page
            } else {
                alert("Logout failed.");
            }
        } catch (error) {
            console.error("Logout Error:", error);
            alert("Something went wrong. Try again.");
        }
    });
} else {
    console.error("Logout button not found!");
}}
