document.addEventListener("DOMContentLoaded", async function () {
    try {
        // Fetch Total Users
        const userResponse = await fetch("/api/user/total");
        const userText = await userResponse.text();
        console.log("🔍 User API Response:", userText);

        if (!userText.trim()) {
            throw new Error("Empty JSON Response");
        }

        const userData = JSON.parse(userText);
        document.getElementById("totalUsers").textContent = userData.total_users ?? "Error";

        // Fetch Total Products
        const productResponse = await fetch("/api/products/total");
        const productText = await productResponse.text();
        console.log("🔍 Product API Response:", productText);

        if (!productText.trim()) {
            throw new Error("Empty JSON Response");
        }

        const productData = JSON.parse(productText);
        document.getElementById("totalProducts").textContent = productData.total_products ?? "Error";
    } catch (error) {
        console.error("❌ Error fetching dashboard stats:", error);
        document.getElementById("totalUsers").textContent = "Error";
        document.getElementById("totalProducts").textContent = "Error";
    }
});
