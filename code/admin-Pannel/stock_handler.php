<?php
include '../user/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['productId']) ? trim($_POST['productId']) : '';
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    if (empty($productId) || empty($action)) {
        echo "Invalid request.";
        exit;
    }

    if ($action === 'restock') {
        if ($quantity <= 0) {
            echo "Invalid quantity.";
            exit;
        }
        $updateQuery = "UPDATE products SET product_stock = product_stock + ? WHERE product_id = ?";
    } elseif ($action === 'unstock') {
        $updateQuery = "UPDATE products SET product_stock = 0 WHERE product_id = ?";
    } else {
        echo "Invalid action.";
        exit;
    }

    $stmt = $conn->prepare($updateQuery);
    if ($action === 'restock') {
        $stmt->bind_param('is', $quantity, $productId);
    } else {
        $stmt->bind_param('s', $productId);
    }

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Database error.";
    }
    $stmt->close();
}
$conn->close();
?>
