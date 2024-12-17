<?php
include 'db_connection.php';
?>

<?php
// Start the session
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

// Retrieve user details from session
$user_id = $_SESSION['user_id'];  // Assuming the user ID is stored in the session during login
$cart = $_SESSION['cart'] ?? [];  // Retrieve the cart details (array of items)
$totalAmount = 0;  // Variable to store the total amount

// Calculate the total cart amount
foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Prepare the cart items for storage (Convert to JSON or serialized array)
$order_items_json = json_encode($cart);

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $payment_method = htmlspecialchars($_POST['payment']);
    $total_amount = floatval($_POST['total_amount']);

    // Ensure the database connection is established
    if (!$conn) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Insert order into the orders table
    $order_sql = "INSERT INTO orders (user_id, name, email, phone, address, payment_method, total_amount, order_status, order_items) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";


    if ($stmt = $conn->prepare($order_sql)) {
        // Bind parameters for the order insertion
        $order_status = 'Pending';
        if ($stmt->bind_param('issssssis', $user_id, $name, $email, $phone, $address, $payment_method, $total_amount, $order_status, $order_items_json)) {
            // Execute the statement
            if ($stmt->execute()) {
                $order_id = $stmt->insert_id;  // Get the order ID of the newly inserted order

                // Clear the cart session after placing the order
                unset($_SESSION['cart']);

                // Store order details in session for the order-success page
                $_SESSION['order_id'] = $order_id;
                $_SESSION['order_total'] = $totalAmount;
                $_SESSION['order_items'] = $cart;

                // Redirect to the order success page
                header("Location: order-success.php");
                exit();
            } else {
                die("Error executing order insertion: " . $stmt->error);
            }
        } else {
            die("Error binding parameters for the order insert query.");
        }
    } else {
        die("Error preparing the order insert query.");
    }

    // Close the statement after execution
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
