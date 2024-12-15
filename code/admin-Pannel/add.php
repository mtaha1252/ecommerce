<?php
include '../user/db_connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $product_name = $_POST['productName'];
    $product_stock = $_POST['productStock'];
    $product_price = $_POST['productPrice'];
    $product_category = $_POST['productCategory'];
    $product_colors = $_POST['productColors'];
    $product_sizes = implode(',', $_POST['productSizes']); // multiple sizes as comma-separated string
    $product_description = $_POST['productDescription'];

    // Admin side - Image upload handling
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/ecom/code/uploads/'; // Path to shared uploads folder
    $productImage1 = preg_replace('/\s+/', '_', $_FILES["productImage1"]["name"]);
    $productImage2 = preg_replace('/\s+/', '_', $_FILES["productImage2"]["name"]);

    // var_dump($target_dir);
    $target_file1 = $target_dir . $productImage1;
    $target_file2 = $target_dir . $productImage2;
    if (move_uploaded_file($_FILES["productImage1"]["tmp_name"], $target_file1)) {
        // echo "File 1 uploaded successfully: " . $target_file1;
    } else {
        echo "Error uploading file 1.";
    }
    
    if (move_uploaded_file($_FILES["productImage2"]["tmp_name"], $target_file2)) {
        // echo "File 2 uploaded successfully: " . $target_file2;
    } else {
        echo "Error uploading file 2.";
    }
    

    // Insert data into the products table
    $sql = "INSERT INTO products (product_name, product_stock, product_price, product_category, product_colors, product_sizes, front_image, rear_image, product_description) 
        VALUES ('$product_name', '$product_stock', '$product_price', '$product_category', '$product_colors', '$product_sizes', '$productImage1', '$productImage2', '$product_description')";

    // Check if query was successful
    if ($conn->query($sql) === TRUE) {
        // Success: Show success message and reset the form
        echo "<script>
                document.getElementById('successMessage').style.display = 'block'; // Display success message
                document.getElementById('addProductForm').reset(); // Reset the form
              </script>";
    } else {
        // Error: Display error message
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="add.css"> <!-- Assuming you have an add.css file for styling -->
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
            <h2>Add Product</h2>
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
            <li><a href="remove.html">Remove Product</a></li>
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

    <!-- Main Content - Add Product Form -->
    <div class="main-content">
        <h1>Add New Product</h1>
        <form id="addProductForm" action="add.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" placeholder="Enter product name" required>
            </div>
            <div class="input-group">
                <label for="productStock">Number of Products in Stock:</label>
                <input type="number" id="productStock" name="productStock" placeholder="Enter quantity in stock" required>
            </div>
            <div class="input-group">
                <label for="productPrice">Price:</label>
                <input type="number" id="productPrice" name="productPrice" placeholder="Enter product price" required>
            </div>
            <div class="input-group">
                <label for="productCategory">Category:</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="">Select a category</option>
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                    <option value="kids">Kids</option>
                </select>
            </div>
            <div class="input-group">
                <label for="productColors">Available Colors:</label>
                <input type="text" id="productColors" name="productColors" placeholder="e.g. Red, Blue, Green" required>
            </div>
            <div class="input-group">
                <label for="productSizes">Available Sizes:</label>
                <select id="productSizes" name="productSizes[]" multiple required>
                    <option value="xs">XS</option>
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                    <option value="xl">XL</option>
                    <option value="xxl">XXL</option>
                </select>
            </div>
            <div class="input-group">
                <label for="productImages">Product Images:</label>
                <input type="file" id="productImage1" name="productImage1" required>
                <input type="file" id="productImage2" name="productImage2" required>
            </div>
            <div class="input-group">
                <label for="productDescription">Description:</label>
                <textarea id="productDescription" name="productDescription" rows="4" placeholder="Enter product description" required></textarea>
            </div>
            <button type="submit">Add Product</button>
        </form>
    </div>
    <script src="add.js"></script>

</body>
</html>
