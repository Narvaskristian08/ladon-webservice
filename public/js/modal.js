document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("productModal");
    const closeModal = document.querySelector(".close");
    const addProductBtn = document.querySelector(".inventory-add-btn");
    const editProductBtn = document.querySelector(".inventory-edit-btn");
    const productForm = document.getElementById("productForm");

    // ✅ Open Add Product Modal
    addProductBtn.addEventListener("click", function () {
        document.getElementById("modalTitle").innerText = "Add Product";
        productForm.reset();
        document.getElementById("productId").value = ""; // Reset Editing Mode
        modal.style.display = "flex";
    });

    // ✅ Close Modal
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // ✅ Open Edit Product Modal
    editProductBtn.addEventListener("click", async function () {
        const selectedCheckbox = document.querySelector("input[type='checkbox']:checked");
        if (!selectedCheckbox) {
            alert("Please select a product to edit.");
            return;
        }

        const productId = selectedCheckbox.getAttribute("data-id");

        try {
            const response = await fetch(`http://localhost:8000/api/products/${productId}`);
            const text = await response.text();
            console.log("🔍 Raw API Response:", text);

            const product = JSON.parse(text);

            if (!product || product.error) {
                alert("❌ Product not found.");
                return;
            }

            // ✅ Populate form fields with product data
            document.getElementById("productName").value = product.product_name || "";
            document.getElementById("productCategory").value = product.product_category || "";
            document.getElementById("productStock").value = product.stock || "0";
            document.getElementById("productPrice").value = product.product_price || "0.00";
            document.getElementById("productId").value = productId;
            document.getElementById("modalTitle").innerText = "Edit Product";
            modal.style.display = "flex";
        } catch (error) {
            console.error("❌ Error fetching product details:", error);
        }
    });

    // ✅ Handle Form Submission (Add/Edit)
    productForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const productId = document.getElementById("productId").value;
        const productName = document.getElementById("productName").value;
        const productCategory = document.getElementById("productCategory").value;
        const productStock = document.getElementById("productStock").value;
        const productPrice = document.getElementById("productPrice").value;
        const productImage = document.getElementById("productImage").files[0]; // ✅ Get File

        if (!productName || !productStock || !productPrice) {
            alert("❌ Please fill in all required fields.");
            return;
        }

        const formData = new FormData();
        formData.append("product_name", productName);
        formData.append("product_category", productCategory);
        formData.append("stock", productStock);
        formData.append("product_price", productPrice);
        if (productImage) {
            formData.append("product_image", productImage); // ✅ Append Image
        }

        let url = "http://localhost:8000/api/products";
        let method = "POST"; // ✅ Default to Add

        if (productId) {
            url = `http://localhost:8000/api/products/${productId}`;
            formData.append("_method", "PUT"); // ✅ Override method for PHP
        }

        try {
            const response = await fetch(url, {
                method: "POST", // ✅ Use POST even for updates (Laravel-style override)
                body: formData,
            });

            const text = await response.text();
            console.log("🔍 Raw API Response:", text);

            if (!text.trim()) {
                throw new Error("❌ Empty JSON Response");
            }

            const result = JSON.parse(text);
            if (result.error) {
                alert("❌ Error: " + result.error);
            } else {
                alert(result.message);
                modal.style.display = "none";
                fetchProducts(); // ✅ Refresh Product List
            }
        } catch (error) {
            console.error("❌ Error submitting form:", error);
            alert("Something went wrong. Please try again.");
        }
    });
});
