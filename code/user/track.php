<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Tracking</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="track.css" />
</head>
<body>


  <?php include 'navbar.php'; ?>

<div class="tracking-container">
  <h1>Track Your Order</h1>
  <form id="trackingForm">
    <label for="orderID">Order ID</label>
    <input type="text" id="orderID" name="orderID" placeholder="Enter your Order ID" required />
    <button type="submit" id="trackButton">Track Order</button>
  </form>
  <div id="orderStatus" class="status-message"></div>
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
          

<script src="track.js"></script>
</body>
</html>
