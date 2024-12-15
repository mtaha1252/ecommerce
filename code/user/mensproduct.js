document.addEventListener("DOMContentLoaded", () => {
    // Check if the elements with the prod-btn class exist
    const prodBtns = document.querySelectorAll(".prod-btn");
    if (prodBtns.length > 0) {
        prodBtns.forEach((button) => {
            button.addEventListener("click", async (e) => {
                e.preventDefault();
    
                // Capture product data from the button's data attributes
                const productId = button.dataset.id;
                const productName = button.dataset.name;
                const productPrice = button.dataset.price;
    
                // Send AJAX request to cartActions.php
                const response = await fetch("cartActions.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        action: "add",
                        id: productId,
                        name: productName,
                        price: productPrice,
                    }),
                });
    
                // Parse the response from the server
                const result = await response.json();
                if (result.success) {
                    alert(result.message);
                    updateCartCount(result.cartCount);
                } else {
                    alert("Failed to add product to cart.");
                }
            });
        });
    } else {
        console.error("No add to cart buttons found.");
    }

    // Menu toggle functionality (open/close navbar on menu click)
    const menu = document.querySelector('#menu-icon');
    const navbar = document.querySelector('.navbar');

    if (menu && navbar) {
        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        };
    }

    // Function to update cart count in the navbar
    const updateCartCount = (count) => {
        const cartCountElement = document.querySelector('#cart-count'); // Assuming there's an element to display cart count
        if (cartCountElement) {
            cartCountElement.textContent = count;
        } else {
            console.error('Cart count element not found');
        }
    };
});
