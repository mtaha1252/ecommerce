<?php
// Start the session to access session variables
session_start();
// Check if the cart session variable exists, if not, initialize it
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
  $_SESSION['cart_total'] = 0;
}

// Update cart total if needed
if (isset($_SESSION['cart'])) {
  $totalAmount = 0;
  foreach ($_SESSION['cart'] as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
  }
  $_SESSION['cart_total'] = $totalAmount; // Store the updated total in the session
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="cart.css">
</head>

<body>
  <?php include 'navbar.php'; ?>

  <main>
    <div class="cart-container">
      <h1>Your Shopping Cart</h1>
      <table id="cartTable">
        <thead>
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="cartItems">
          <?php
          // Display cart items
          if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $item) {
              echo "
                            <tr data-id='{$id}'>
                                <td>{$item['name']}</td>
                                <td>{$item['price']}</td>
                                <td>{$item['quantity']}</td>
                                <td>" . $item['price'] * $item['quantity'] . "</td>
                                <td>
                                    <button class='remove-btn' data-id='{$id}'>Remove</button>
                                </td>
                            </tr>
                            ";
            }
          } else {
            echo "<tr><td colspan='5'>Your cart is empty!</td></tr>";
          }
          ?>
        </tbody>
      </table>

      <div class="cart-summary">
        <h2>Total Amount:<span id="cartTotal">
            <?php
            echo isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : '0.00';
            ?>
          </span></h2>
        <button type="button" id="checkoutButton">Proceed to Checkout</button>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2024 A & H Clothing. All rights reserved.</p>
  </footer>

  <script src="cart.js"></script>
  <script>
    document.getElementById('checkoutButton').addEventListener('click', function() {
      window.location.href = 'checkout.php';
    });
  </script>
</body>

</html>