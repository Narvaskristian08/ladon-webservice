document.addEventListener("DOMContentLoaded", async function () {
    try {
        const response = await fetch("/api/user/total");
        const data = await response.json();

        if (response.ok) {
            document.getElementById("totalUsers").textContent = data.total_users;
        } else {
            document.getElementById("totalUsers").textContent = "Error";
        }
    } catch (error) {
        console.error("Error fetching total users:", error);
        document.getElementById("totalUsers").textContent = "Error";
    }
});
