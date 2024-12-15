document.addEventListener('DOMContentLoaded', () => {
  loadCart(); // Load the cart on page load

  // Delegate event to dynamically created remove buttons
  document.querySelector('#cartItems').addEventListener('click', async (e) => {
      if (e.target && e.target.classList.contains('remove-btn')) {
          // Get the product ID to remove
          const id = e.target.dataset.id;

          try {
              // Send remove request to the backend
              const response = await fetch('cartActions.php', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({ action: 'remove', id: id })
              });

              // Check if response is okay
              if (!response.ok) {
                  throw new Error('Failed to communicate with server');
              }

              // Get the result of the operation
              const result = await response.json();

              if (result.success) {
                  alert(result.message);  // Show success message

                  // Update the cart display with the updated cart content
                  updateCartDisplay(result.cart, result.cart_total);
              } else {
                  alert(result.message);  // Show error message if removal failed
              }
          } catch (error) {
              console.error('Error during cart operation:', error);
              alert('Something went wrong! Please try again.');
          }
      }
  });
});

// Function to update the cart display
function updateCartDisplay(cartData, cartTotal) {
  const cartItemsContainer = document.querySelector('#cartItems');
  cartItemsContainer.innerHTML = ''; // Clear the current cart display

  let total = 0;

  // Check if cart data exists
  if (cartData && Object.keys(cartData).length > 0) {
      Object.keys(cartData).forEach(id => {
          const item = cartData[id];

          // Convert item.price to a valid float number, if it's not already
          const price = parseFloat(item.price);  // Safely convert the price to a number
          if (isNaN(price)) {
              console.error('Invalid price value:', item.price);
              return; // Skip this item if the price is invalid
          }

          total += price * item.quantity; // Calculate the total for each item

          // Display updated cart items
          cartItemsContainer.innerHTML += `
              <tr>
                  <td>${item.name}</td>
                  <td>$${price.toFixed(2)}</td> <!-- Format price to two decimal places -->
                  <td>${item.quantity}</td>
                  <td>$${(price * item.quantity).toFixed(2)}</td>
                  <td><button class="remove-btn" data-id="${id}">Remove</button></td>
              </tr>
          `;
      });
  } else {
      cartItemsContainer.innerHTML = "<tr><td colspan='5'>Your cart is empty!</td></tr>";
      total = 0; // Reset total to 0 when the cart is empty
  }

  // Update the cart total on the page
  const totalElement = document.querySelector('#cartTotal');
  if (cartTotal !== undefined && cartTotal !== null) {
      totalElement.textContent = `$${parseFloat(cartTotal).toFixed(2)}`;
  } else {
      // In case cartTotal is not provided in the response, use the calculated total
      totalElement.textContent = `$${total.toFixed(2)}`;
  }
}

// Function to load the cart data
async function loadCart() {
  try {
      const response = await fetch('cartActions.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'view' })
      });

      if (!response.ok) {
          throw new Error('Failed to load cart');
      }

      const result = await response.json();

      if (result.success) {
          // Call function to display the cart and total
          updateCartDisplay(result.cart, result.cart_total);
      } else {
          alert(result.message); // Show error message if loading cart fails
      }
  } catch (error) {
      console.error('Error loading cart:', error);
      alert('Unable to load cart data.');
  }
}
