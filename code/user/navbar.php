<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started already
}
// Include the database connection file
include 'db_connection.php';
// Query to fetch categories
$query = "SELECT * FROM `categories`";
$result = $conn->query($query);

// Fetch all categories
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <a href="#" class="logo"><img src="logo.png"></a>
    <ul class="navbar">
        <li><a href="main.php">Home</a></li>
        <li><a href="arrival.php">New Arrivals</a></li>
        <li class="dropdown">
            <a>Categories</a>
            <ul class="dropdown-content">
                <?php
                // Loop through categories and display them dynamically
                foreach ($categories as $category) {
                    // Check if the category name is valid and use it in the URL
                    $categoryName = strtolower($category['name']);
                    echo '<li><a href="' . $categoryName . 'product.php">' . htmlspecialchars($category['name']) . '</a></li>';
                }
                ?>
            </ul>

        </li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
    <div class="nav-icon">
        <a href="#"><i class="bx bx-search"></i></a>
        <a href="track.php"><i class='bx bxs-bus'></i></a>

        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="sign-out.php"><i class="bx bx-log-out"></i></a> <!-- Sign-out link -->
        <?php else: ?>
            <a href="sign-in.php"><i class='bx bx-user'></i></a>
        <?php endif; ?>

        <a href="cart.php"><i class='bx bx-cart'></i></a>

        <div class="menu-icon" id="menu-icon">
            <a href="#"><i class='bx bx-menu'></i></a>
        </div>
    </div>
</header>