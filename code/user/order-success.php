<?php
session_start();
// Check if order details are available in the session
if (!isset($_SESSION['order_id'])) {
    // If no order ID is found in the session, redirect to the homepage or checkout page
    header("Location: checkout.php");
    exit();
}

// Retrieve the order details (For example, the order ID)
$order_id = $_SESSION['order_id']; 
$order_total = $_SESSION['order_total'];  // You can store the total amount in the session during the checkout process
$order_items = $_SESSION['order_items'];  // Store order items details, could be an array

// Optionally clear order details from the session to prevent reuse
unset($_SESSION['order_id']);
unset($_SESSION['order_total']);
unset($_SESSION['order_items']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="order-success.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="order-success-container">
            <h1>Thank you for your order!</h1>
            <p>Your order has been successfully placed.</p>
            <p>Order ID: <strong><?php echo $order_id; ?></strong></p>
            <p>Total Amount: <strong>$<?php echo number_format($order_total, 2); ?></strong></p>

            <h2>Order Details:</h2>
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
                    <?php if (!empty($order_items)): ?>
                        <?php foreach ($order_items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo intval($item['quantity']); ?></td>
                                <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No items in this order.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <p>We are processing your order. You will receive an email confirmation soon!</p>
            <a href="main.php" class="btn">Return to Home</a>
        </div>
    </main>
</body>

</html>
