<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit();
  }

  $query = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already exists in our system.']);
    exit();
  }

  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
  $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
  $insertStmt = $conn->prepare($insertQuery);
  $insertStmt->bind_param("sss", $username, $email, $hashedPassword);

  if ($insertStmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Account created successfully.']);
    exit();
  } else {
    echo json_encode(['success' => false, 'message' => 'Error creating account. Please try again.']);
    exit();
  }

  $stmt->close();
  $insertStmt->close();
  $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign-Up Page</title>
  <link rel="stylesheet" href="signup.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="form-container">
      <h1>Sign Up</h1>
      <?php
      if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
      }
      if (isset($success_message)) {
        echo "<p class='success'>$success_message</p>";
      }
      ?>
      <form method="POST" id="signupForm">
        <label for="username">Full Name</label>
        <input type="text" id="username" name="username" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        <span class="eye-icon1" id="eye-icon1">👁️</span>

        <p id="passwordRequirements" class="requirements">
          <span id="passwordLength" class="invalid">At least 8 characters, </span>
          <span id="passwordLowercase" class="invalid">one lowercase letter, </span>
          <span id="passwordUppercase" class="invalid">one uppercase letter, </span>
          <span id="passwordDigit" class="invalid">one digit, </span>
          <span id="passwordSpecial" class="invalid">one special character (!@#$%^&*).</span>
        </p>

        <!-- Confirm Password Field -->
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required />
        <span class="eye-icon2" id="eye-icon2">👁️</span>

        <p id="confirmPasswordRequirements" class="requirements">
          <span id="confirmPasswordMatch" class="invalid">Passwords must match.</span>
        </p>

        <button type="submit" id="signupButton">Sign Up</button>
      </form>
      <p class="login-link">Already Have an Account? <a href="sign-in.php">Sign In</a></p>
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
  </div>

  <script src="sign-up.js"></script>
</body>

</html>