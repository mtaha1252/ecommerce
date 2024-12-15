
<?php
include 'db_connection.php';


$query = "SELECT * FROM cover_images";
$result = $conn->query($query);
$images = $result->fetch_all(MYSQLI_ASSOC);
?>

<!-- for products data fecting  -->

<?php

// Fetch all products from the database
$query = "SELECT * FROM products";  // Assuming you're fetching all products
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // If the result is not empty, fetch all rows as an associative array
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // If the query fails, handle the error
    echo "Error fetching products: " . $conn->error;
    $products = []; // Set $products to an empty array if query fails
}


ini_set('display_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Website</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
  
  <?php include 'navbar.php'; ?>
  <?php if (isset($_SESSION['username'])): ?>
  <?php else: ?>
    <?php include 'newsletter.php'; ?>
  <?php endif; ?>


  <div class="container">
    <div class="slide">
      <?php foreach ($images as $image) { 
        $imagePath = '../uploads/' . $image['image']; ?>
        
        <div class="item" style="background-image: url('<?php echo $imagePath; ?>');">
        </div>
      <?php } ?>
    </div>

    <div class="button">
      <button class="prev"><i class='bx bx-left-arrow-alt'></i></button>
      <button class="next"><i class='bx bx-right-arrow-alt'></i></button>
    </div>
  </div>

  <!-- Men Products Section -->
<div class="mainwrapped" id="men-section">
    <div class="contain">
        <div class="title">
            <h2>Men Products</h2>
        </div>
        <div class="prod-grid">
            <?php foreach ($products as $product) { 
                if ($product['product_category'] === 'men') { // Check for Men category
                    $frontImagePath = '../uploads/' . trim($product['front_image']); // Front image
                    $rearImagePath = '../uploads/' . trim($product['rear_image']); // Rear image
            ?>
                <div class="product">
                    <div class="prod-img">
                        <img src="<?php echo $frontImagePath; ?>" alt="product front image" />
                        <?php if (!empty($rearImagePath)): ?>
                            <img src="<?php echo $rearImagePath; ?>" alt="product rear image" class="rear-img" />
                        <?php endif; ?>
                    </div>
                    <div class="prod-info">
                        <div>
                            <div class="rate">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <span class="prod-price">$<?php echo $product['product_price']; ?></span>
                        </div>
                        <a href="#" class="prod-btn">Add to Cart</a>
                    </div>
                </div>
            <?php 
                } 
            } ?>
        </div>
    </div>
</div>

<!-- Kids Products Section -->
<div class="mainwrapped" id="kid-section">
    <div class="contain">
        <div class="title">
            <h2>Kids Products</h2>
        </div>
        <div class="prod-grid">
            <?php foreach ($products as $product) { 
                if ($product['product_category'] === 'kids') { // Check for Kids category
                    $frontImagePath = '../uploads/' . trim($product['front_image']); // Front image
                    $rearImagePath = '../uploads/' . trim($product['rear_image']); // Rear image
            ?>
                <div class="product">
                    <div class="prod-img">
                        <img src="<?php echo $frontImagePath; ?>" alt="product front image" />
                        <?php if (!empty($rearImagePath)): ?>
                            <img src="<?php echo $rearImagePath; ?>" alt="product rear image" class="rear-img" />
                        <?php endif; ?>
                    </div>
                    <div class="prod-info">
                        <div>
                            <div class="rate">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <span class="prod-price">$<?php echo $product['product_price']; ?></span>
                        </div>
                        <a href="#" class="prod-btn">Add to Cart</a>
                    </div>
                </div>
            <?php 
                } 
            } ?>
        </div>
    </div>
</div>

<!-- Women Products Section -->
<div class="mainwrapped" id="women-section">
    <div class="contain">
        <div class="title">
            <h2>Women Products</h2>
        </div>
        <div class="prod-grid">
            <?php foreach ($products as $product) { 
                if ($product['product_category'] === 'women') { // Check for Women category
                    $frontImagePath = '../uploads/' . trim($product['front_image']); // Front image
                    $rearImagePath = '../uploads/' . trim($product['rear_image']); // Rear image
            ?>
                <div class="product">
                    <div class="prod-img">
                        <img src="<?php echo $frontImagePath; ?>" alt="product front image" />
                        <?php if (!empty($rearImagePath)): ?>
                            <img src="<?php echo $rearImagePath; ?>" alt="product rear image" class="rear-img" />
                        <?php endif; ?>
                    </div>
                    <div class="prod-info">
                        <div>
                            <div class="rate">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <span class="prod-price">$<?php echo $product['product_price']; ?></span>
                        </div>
                        <a href="#" class="prod-btn">Add to Cart</a>
                    </div>
                </div>
            <?php 
                } 
            } ?>
        </div>
    </div>
</div>


  <footer class="footer">
    <div class="footer-content">
      <div>
        <h3>Follow Us</h3>
        <div class="social-media">
          <a href="https://facebook.com"><i class="bx bxl-facebook"></i></a>
          <a href="https://twitter.com"><i class="bx bxl-twitter"></i></a>
          <a href="https://instagram.com"><i class="bx bxl-instagram"></i></a>
          <a href="https://linkedin.com"><i class="bx bxl-linkedin"></i></a>
          <a href="https://youtube.com"><i class="bx bxl-youtube"></i></a>
        </div>
      </div>
      <div>
        <h3>Contact Us</h3>
        <p>Email: support@yourwebsite.com</p>
        <p>Phone: +123 456 7890</p>
      </div>
      <div>
        <h3>Need Help?</h3>
        <div class="report-problem">
          <a href="#">Report a Problem</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2024 A & H Clothing. All rights reserved.
    </div>
  </footer>

  <script src="main.js"></script>
</body>
</html>