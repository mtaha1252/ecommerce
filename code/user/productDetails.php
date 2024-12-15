<?php
include 'db_connection.php';
$product_id = $_GET['product_id']; // Get the product ID from the URL

// Validate product_id to avoid SQL Injection and ensure it is an integer
$product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);

// Prepare the SQL statement to avoid SQL injection
$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);

// Bind the parameter to the query
$stmt->bind_param("i", $product_id); // "i" denotes integer type for product_id

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch a single product
$product = $result->fetch_assoc(); // Fetches a single row as an associative array

// Check if the product exists
if (!$product) {
    echo "Product not found.";
    exit;
}

$frontImagePath = '../uploads/' . trim($product['front_image']);
$rearImagePath = !empty($product['rear_image']) ? '../uploads/' . trim($product['rear_image']) : null; // If rear_image exists, construct the path
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Details</title>
    <link rel="stylesheet" href="productDetails.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div id="product-popup">
        <button id="close-popup" onclick="closePopup()">x</button>
        <div class="prod-details">
            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <div class="prod-img">
                <img src="<?php echo $frontImagePath; ?>" alt="Product Front">
                <?php if ($rearImagePath): ?>
                    <img src="<?php echo $rearImagePath; ?>" alt="Product Rear">
                <?php endif; ?>
            </div>
            <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['product_price']); ?></p>
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p> <!-- Added nl2br for formatting -->
        </div>
    </div>
    <script src="sign-up.js"></script>
</body>

</html>