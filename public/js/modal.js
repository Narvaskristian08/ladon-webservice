document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("productModal");
    const closeModal = document.querySelector(".close");
    const addProductBtn = document.querySelector(".inventory-add-btn");
    const editProductBtn = document.querySelector(".inventory-edit-btn");
    const productForm = document.getElementById("productForm");
    let editingProductId = null;

    // ✅ Open Add Product Modal
    addProductBtn.addEventListener("click", function () {
        document.getElementById("modalTitle").innerText = "Add Product";
        productForm.reset();
        editingProductId = null; // Reset Editing Mode
        modal.style.display = "block";
    });

    // ✅ Close Modal
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // ✅ Handle Form Submission (Add/Edit)
    productForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const productName = document.getElementById("productName").value;
        const productCategory = document.getElementById("productCategory").value;
        const productStock = document.getElementById("productStock").value;
        const productPrice = document.getElementById("productPrice").value;
        const productImage = document.getElementById("productImage").files[0];

        const formData = new FormData();
        formData.append("name", productName);
        formData.append("category", productCategory);
        formData.append("stock_quantity", productStock);
        formData.append("price", productPrice);
        if (productImage) formData.append("image", productImage);

        let url = "http://localhost:8000/api/products";
        let method = "POST"; // Default to Add

        if (editingProductId) {
            url = `http://localhost:8000/api/products/${editingProductId}`;
            method = "PUT"; // Change to Edit
        }

        try {
            const response = await fetch(url, {
                method: method,
                body: formData
            });

            const result = await response.json();
            alert(result.message);
            modal.style.display = "none"; // Close modal after success

            fetchProducts(); // Refresh table
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong.");
        }
    });
});
