<?php
include 'db_connection.php';
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

$name = htmlspecialchars($_SESSION['username'] ?? ''); // Secure against XSS attacks
$email = htmlspecialchars($_SESSION['email'] ?? '');
$cart = $_SESSION['cart'] ?? []; // Retrieve cart details

// Calculate the total amount
$totalAmount = 0;
foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="checkout-container">
            <h1>Checkout</h1>
            <!-- Cart Summary -->
            <section class="cart-summary">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cart)): ?>
                            <?php foreach ($cart as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                                    <td><?php echo intval($item['quantity']); ?></td>
                                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Your cart is empty.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="cart-total">
                    <strong>Total Amount:</strong> $<?php echo number_format($totalAmount, 2); ?>
                </div>
            </section>

            <hr>

            <!-- Checkout Form -->
            <form action="checkoutActions.php" method="POST">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly required>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly required>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" title="Enter a 10-digit phone number" required>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="4" placeholder="Enter your delivery address" required></textarea>
                </div>

                <!-- Payment Method -->
                <div class="form-group">
                    <label for="payment">Payment Method</label>
                    <select id="payment" name="payment" required>
                        <option value="cod">Cash on Delivery</option>
                        <!-- <option value="online">Online Payment</option> -->
                    </select>
                </div>

                <!-- Hidden Total Field -->
                <input type="hidden" name="total_amount" value="<?php echo number_format($totalAmount, 2); ?>">

                <!-- Place Order Button -->
                <button type="submit" class="btn">Place Order</button>
            </form>
        </div>
    </main>
</body>

</html>