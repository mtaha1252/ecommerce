
const cartItems=[];
document.getElementById('checkoutButton').addEventListener('click', function () {
    const emptyCartMessageElement = document.getElementById('emptyCartMessage');
    emptyCartMessageElement.innerHTML = ''; // Clear previous message
    
    if (cartItems.length === 0) {
      emptyCartMessageElement.innerHTML = `
        <p style="color: red; margin-top: 10px;">Nothing in cart, <a href="index.html" style="color: green; text-decoration: none;">continue shopping</a>.</p>
      `;
    } else {
      alert('Proceeding to Checkout!');
    }
  });
  let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick =() => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}