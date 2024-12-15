<?php
include '../user/db_connection.php'; // Include the database connection
$message = ''; // Initialize an empty message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the Product ID and Product Name
    $product_id = isset($_POST['productIdentifier']) ? trim($_POST['productIdentifier']) : '';
    $product_name = isset($_POST['productName']) ? trim($_POST['productName']) : '';

    // Check if at least one identifier is provided
    if (empty($product_id) && empty($product_name)) {
        $message = 'Please provide a Product ID or Product Name.';
    } else {
        // Build the SQL condition dynamically
        $conditions = [];
        if (!empty($product_id)) {
            $conditions[] = "product_id = '$product_id'";
        }
        if (!empty($product_name)) {
            $conditions[] = "product_name = '$product_name'";
        }
        $where_clause = implode(' OR ', $conditions);

        // Check if the product exists
        $check_sql = "SELECT * FROM products WHERE $where_clause";
        $check_result = $conn->query($check_sql);

        if ($check_result && $check_result->num_rows > 0) {
            // If the product exists, delete it
            $delete_sql = "DELETE FROM products WHERE $where_clause";
            if ($conn->query($delete_sql) === TRUE) {
                $message = 'Product has been removed successfully!';
            } else {
                $message = 'Error removing product: ' . $conn->error;
            }
        } else {
            // Product does not exist
            $message = 'Product with the provided ID or Name does not exist.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Product</title>
    <link rel="stylesheet" href="remove.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="menu-toggle">
            <i class='bx bx-menu'></i>
        </div>
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <nav class="navbar">
            <h2>Remove Product</h2>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
      <ul>
        <li><a href="dashboard.html"><i class='bx bx-user'></i>DashBoard</a></li>
        <li class="products-dropdown">
          <a href="#"><i class='bx bx-box'></i> Products Management</a>
          <ul class="products-dropdown-content">
            <li><a href="add.html">Add Product</a></li>
            <li><a href="remove.php">Remove Product</a></li>
            <li><a href="stock.html">Restock/Out of Stock</a></li>
          </ul>
        </li>
        <li><a href="payments.html"><i class='bx bx-credit-card'></i> Payments and Transactions</a></li>
        <li><a href="orders.html"><i class='bx bx-cart'></i> Orders</a></li>
        <li><a href="registeredCustomers.html"><i class='bx bx-group'></i> Registered Customers</a></li>
        <li><a href="CustomerSupport.html"><i class='bx bx-headphone'></i> Customer Support System</a></li>
        <li><a href="shipping.html"><i class='bx bx-package'></i> Shipping & Delivery Management</a></li>
      </ul>
    </aside>

    <!-- Main Content - Remove Product Form -->
    <div class="main-content">
        <h1>Remove Product</h1>

        <!-- Display the success or error message -->
        <?php if (!empty($message)): ?>
            <div class="message" style="margin-bottom: 20px; padding: 10px; background-color: #f5f5f5; color: maroon; border: 1px solid maroon; border-radius: 5px;">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form id="removeProductForm" action="remove.php" method="POST">
            <div class="input-group">
                <label for="productIdentifier">Product ID:</label>
                <input type="number" id="productIdentifier" name="productIdentifier" placeholder="Enter Product ID">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" placeholder="Enter Product Name">
            </div>
            <button type="submit">Remove Product</button>
        </form>
    </div>

    <script src="remove_pro.js"></script>
</body>
</html>
