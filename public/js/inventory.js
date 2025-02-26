document.addEventListener("DOMContentLoaded", function () {
    fetchProducts(); // Load products on page load

    // ✅ Attach Event Listeners to Global Buttons
    document.querySelector(".inventory-edit-btn").addEventListener("click", editSelectedProduct);
    document.querySelector(".inventory-delete-btn").addEventListener("click", deleteSelectedProducts);
});

// ✅ Fetch & Display Products
async function fetchProducts() {
    try {
        const response = await fetch("http://localhost:8000/api/products");
        const text = await response.text();
        console.log("🔍 Raw API Response:", text);

        if (!text.trim()) {
            throw new Error("Empty JSON Response");
        }

        let products;
        try {
            products = JSON.parse(text);
        } catch (error) {
            console.error("❌ JSON Parse Error:", error);
            return;
        }

        const tableBody = document.querySelector(".inventory-table tbody");
        tableBody.innerHTML = ""; // Clear previous entries

        products.forEach(product => {
            if (!product.id || !product.product_name) {
                console.error("❌ Skipping undefined product:", product);
                return;
            }

            let imageSrc = "/img/placeholder.jpg"; // Default Image
            if (product.product_image && product.product_image !== "null") {
                imageSrc = `data:image/png;base64,${product.product_image}`;
            }

            const row = document.createElement("tr");
            row.classList.add("inventory-tr");
            row.innerHTML = `
                <td class="inventory-td"><input type="checkbox" data-id="${product.id}"></td>
                <td class="inventory-td">${product.product_name || "Unnamed Product"}</td>
                <td class="inventory-td">${product.product_category || "N/A"}</td>
                <td class="inventory-td">${product.stock || "0"}</td>
                <td class="inventory-td">₱${product.product_price || "0.00"}</td>
                <td class="inventory-td">
                    <img src="${imageSrc}" class="product-img" alt="Product Image">
                </td>
            `;
            tableBody.appendChild(row);
        });

        // ✅ Reattach Click Events after Table Refresh
        document.querySelector(".inventory-edit-btn").addEventListener("click", editSelectedProduct);
        document.querySelector(".inventory-delete-btn").addEventListener("click", deleteSelectedProducts);
    } catch (error) {
        console.error("❌ Error fetching products:", error);
    }
}


// ✅ Open Edit Modal with Selected Product
async function deleteSelectedProducts() {
    const selectedCheckboxes = document.querySelectorAll("input[type='checkbox']:checked");
    if (selectedCheckboxes.length === 0) {
        alert("Please select a product to delete.");
        return;
    }

    if (!confirm("Are you sure you want to delete selected products?")) return;

    for (let checkbox of selectedCheckboxes) {
        const productId = checkbox.getAttribute("data-id");

        try {
            const response = await fetch(`http://localhost:8000/api/products/${productId}`, {
                method: "DELETE",
                headers: { "Content-Type": "application/json" }
            });

            const text = await response.text();
            console.log("🔍 Raw API Response:", text);

            try {
                const result = JSON.parse(text);
                if (result.error) {
                    alert("❌ Failed to delete product: " + result.error);
                    return;
                }
            } catch (error) {
                console.error("❌ JSON Parse Error:", error);
                return;
            }
        } catch (error) {
            console.error("❌ Error deleting product:", error);
            return;
        }
    }

    alert("✅ Products deleted successfully!");
    fetchProducts(); // ✅ Refresh the table
}



async function editSelectedProduct() {
    const selectedCheckboxes = document.querySelectorAll("input[type='checkbox']:checked");
    if (selectedCheckboxes.length !== 1) {
        alert("Please select exactly one product to edit.");
        return;
    }

    const productId = selectedCheckboxes[0].getAttribute("data-id");

    try {
        const response = await fetch(`http://localhost:8000/api/products/${productId}`);
        const text = await response.text();
        console.log("🔍 Raw API Response:", text);

        const jsonStart = text.indexOf("{");
        const jsonText = text.substring(jsonStart).trim();
        const product = JSON.parse(jsonText);

        if (!product || product.error) {
            alert("❌ Product not found.");
            return;
        }

        document.getElementById("productName").value = product.product_name || "";
        document.getElementById("productCategory").value = product.product_category || "";
        document.getElementById("productStock").value = product.stock || "0";
        document.getElementById("productPrice").value = product.product_price || "0.00";
        document.getElementById("productId").value = productId;
        document.getElementById("modalTitle").innerText = "Edit Product";
        document.getElementById("productModal").style.display = "flex";
    } catch (error) {
        console.error("❌ Error fetching product details:", error);
    }
}



