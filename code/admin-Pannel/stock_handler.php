<?php
include '../user/db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch all products
    $query = "SELECT product_id, product_name, product_stock FROM products";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "{$row['product_id']}|{$row['product_name']}|{$row['product_stock']}\n";
        }
    } else {
        echo "No products found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update stock based on action
    $productId = isset($_POST['productId']) ? trim($_POST['productId']) : '';
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if (empty($productId) || empty($action)) {
        echo "Invalid request. Product ID and action are required.";
        exit;
    }

    if ($action === 'restock') {
        if ($quantity <= 0) {
            echo "Invalid quantity for restocking.";
            exit;
        }
        $query = "UPDATE products SET product_stock = product_stock + ? WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('is', $quantity, $productId);
        if ($stmt->execute()) {
            echo "Product restocked successfully.";
        } else {
            echo "Failed to restock product.";
        }
        $stmt->close();
    } elseif ($action === 'unstock') {
        $query = "UPDATE products SET product_stock = 0 WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $productId);
        if ($stmt->execute()) {
            echo "Product set to out of stock successfully.";
        } else {
            echo "Failed to unstock product.";
        }
        $stmt->close();
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request method.";
}
$conn->close();
?>
