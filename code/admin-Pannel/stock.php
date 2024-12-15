
<?php
include '../user/db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['productId']) ? trim($_POST['productId']) : '';
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    if (empty($productId) || empty($action)) {
        die("Invalid request. Product ID and action are required.");
    }

    // Handle Restock
    if ($action === 'restock') {
        if ($quantity <= 0) {
            die("Invalid quantity for restocking.");
        }

        $updateQuery = "UPDATE products SET product_stock = product_stock + $quantity WHERE product_id = '$productId'";
        if ($conn->query($updateQuery) === TRUE) {
            
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Handle Unstock
    if ($action === 'unstock') {
        $updateQuery = "UPDATE products SET product_stock = 0 WHERE product_id = '$productId'";
        if ($conn->query($updateQuery) === TRUE) {
           
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restock / Unstock Products</title>
    <link rel="stylesheet" href="stock.css">
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
            <h2>Restock / Unstock Products</h2>
        </nav>
    </header>

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

    <!-- Main Content -->
    <div class="main-content">
        <h1>Restock or Unstock Products</h1>
        <div class="table-container">
            <table id="productsTable">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   include '../user/db_connection.php'; 

                    $query = "SELECT product_id, product_name, product_stock FROM products";
                    $result = $conn->query($query);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['product_id']}</td>
                            <td>{$row['product_name']}</td>
                            <td>{$row['product_stock']}</td>
                            <td>
                                <form method='POST' action='stock_handler.php' style='display:inline;'>
                                    <input type='hidden' name='productId' value='{$row['product_id']}'>
                                    <input type='hidden' name='action' value='restock'>
                                    <input type='number' name='quantity' placeholder='Add Qty' required>
                                    <button type='submit'>Restock</button>
                                </form>
                                <form method='POST' action='stock_handler.php' style='display:inline;'>
                                    <input type='hidden' name='productId' value='{$row['product_id']}'>
                                    <input type='hidden' name='action' value='unstock'>
                                    <button type='submit'>Unstock</button>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="stock.js"></script>
</body>
</html>
