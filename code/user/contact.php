
<?php
include 'db_connection.php'; // Include database connection
ini_set('display_errors', 1);
error_reporting(E_ALL);

$message_sent = false; // To track if the form was submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input
    $name = isset($_POST['name']) ? trim($_POST['name']) : ''; // Correct the name field
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validate input
    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Insert the query into the database
            $query = "INSERT INTO queries (customer_name, email, inquiry) VALUES (?, ?, ?)"; // Match database column names
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param('sss', $name, $email, $message);

                if ($stmt->execute()) {
                    $message_sent = true;
                } else {
                    $error = "Failed to send your message. Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $error = "Failed to prepare the statement. Error: " . $conn->error;
            }
        } else {
            $error = "Invalid email format.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="contact.css">
</head>
<body>

    <?php include 'navbar.php'; ?>
    <div class="contact">
      
 <div class="content">
    <h2>Contact Us</h2>
 </div>
        <div class="contact-container">
            
            <div class="contact-info">
                <div class="box">
                    <div class="icon"><a href="#"><i class='bx bx-map'></i></a></div>
                    <div class="text">
                        |<h3>Address</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt, autem!
                        </p>
                    </div>
                </div>

                <div class="box">
                    <div class="icon"><a href="#"><i class='bx bxs-phone'></i></a></div>
                    <div class="text">
                        |<h3>Phone</h3>
                        <p>0300-0000000
                        </p>
                    </div>
                </div>

                <div class="box">
                    <div class="icon"><a href="#"><i class='bx bxs-envelope'></i></a></div>
                    <div class="text">
                        |<h3>E-mail</h3>
                        <p>ha628@gmail.com
                        </p>
                    </div>
                </div>


            </div>
            <div class="contact-form">
    <form method="POST" action="">
        <h2>Send Message</h2>
        <div class="inputbox">
            <input type="text" name="name" required placeholder="Full Name">
        </div>
        <div class="inputbox">
            <input type="email" name="email" required placeholder="E-mail">
        </div>
        <div class="inputbox">
            <textarea name="message" required placeholder="Type your message..."></textarea>
        </div>
        <div class="inputbox">
            <input type="submit" value="Send">
        </div>
    </form>
</div>

        
        </div>
    </div>
    <script src="contact.js"></script>
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
      
</body>
</html>