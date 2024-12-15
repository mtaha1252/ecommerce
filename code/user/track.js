document.getElementById('trackingForm').addEventListener('submit', function (event) {
    event.preventDefault();
  
    const orderID = document.getElementById('orderID').value;
    const orderStatusElement = document.getElementById('orderStatus');
  
    if (orderID === '12345') {
      orderStatusElement.textContent = 'Order is in transit. Expected delivery: 3 days.';
      orderStatusElement.style.color = 'green';
    } else if (orderID === '67890') {
      orderStatusElement.textContent = 'Order has been delivered.';
      orderStatusElement.style.color = 'blue';
    } else {
      orderStatusElement.textContent = 'Order not found. Please check your Order ID.';
      orderStatusElement.style.color = 'red';
    }
  });
  
  let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick =() => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}