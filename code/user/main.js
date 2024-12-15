let next = document.querySelector('.next')
let prev = document.querySelector('.prev')

next.addEventListener('click', function () {
    let items = document.querySelectorAll('.item')
    document.querySelector('.slide').appendChild(items[0])
})

prev.addEventListener('click', function () {
    let items = document.querySelectorAll('.item')
    document.querySelector('.slide').prepend(items[items.length - 1])
})
setInterval(function () {
    let items = document.querySelectorAll('.item');
    document.querySelector('.slide').appendChild(items[0]);
}, 5000);


// document.addEventListener("DOMContentLoaded", function () {
//     const buttons = document.querySelectorAll('.some-button-class');
//     buttons.forEach(button => {
//         button.addEventListener('click', () => {
//             // Your onclick code here
//         });
//     });
// });

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}




document.addEventListener("DOMContentLoaded", () => {
    // Add event listener for Add to Cart buttons
    document.querySelectorAll(".prod-btn").forEach((button) => {
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

            // Parse response
            const result = await response.json();
            if (result.success) {
                alert(result.message);
            } else {
                alert("Failed to add product to cart.");
            }
        });
    });
});
