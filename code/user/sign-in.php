<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];

      echo json_encode(['success' => true, 'message' => 'Sign In Successful!']);
      exit();
    } else {
      echo json_encode(['success' => false, 'message' => 'Invalid password.']);
      exit();
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'Email not found.']);
    exit();
  }

  $stmt->close();
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign-In Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="signin.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="container">
    <div class="form-container">
      <h1>Sign In</h1>
      <form id="signinForm">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        <span class="eye-icon" id="eye-icon">👁️</span>


        <button type="submit" id="signinButton">Sign In</button>
      </form>
      <p class="login-link">Don't Have an Account? <a href="sign-up.php">Sign Up</a></p>
    </div>
    <div class="policy-container">
      <div class="policy">
        <h2>Why we need your contact info?</h2>
        <div class="policy-content">
          <ul>
            <li>Exclusive Access: Be the first to know about upcoming collections and limited-edition launches.</li>
            <li>Early Notifications: Receive timely alerts for new arrivals and special promotions.</li>
            <li>Priority Access: Get priority access to sales, events, and exclusive deals.</li>
            <li>Personalized Recommendations: Enjoy a tailored shopping experience with fashion picks based on your preferences.</li>
            <li>Stay Ahead of Trends: Keep up with the latest fashion trends and never miss a launch.</li>
          </ul>
        </div>
      </div>
    </div>

    <script src="sign-in.js"></script>
</body>

</html>