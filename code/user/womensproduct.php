<?php
include 'db_connection.php';

// Fetch all products with category 'kids'
$query = "SELECT * FROM products WHERE product_category = 'women'";
$result = $conn->query($query);

if ($result) {
  $womensProducts = $result->fetch_all(MYSQLI_ASSOC);
} else {
  echo "Error fetching products: " . $conn->error;
  $womensProducts = [];
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kids Products</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>

  <!-- Include Navbar -->
  <?php include 'navbar.php'; ?>

  <!-- Kids Products Section -->
  <div class="mainwrapped" id="women-section">
    <div class="contain">
      <div class="title">
        <h2>Women Products</h2>
      </div>
      <div class="prod-grid">
        <?php foreach ($womensProducts as $product) {
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
                <a href="#" class="prod-btn"
                  data-id="<?php echo $product['product_id']; ?>"
                  data-name="<?php echo $product['product_name']; ?>"
                  data-price="<?php echo $product['product_price']; ?>">
                  Add to Cart
                </a>

              </div>
            </div>
        <?php
          }
        } ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
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

  <script src="womenproducts.js"></script>
</body>

</html>