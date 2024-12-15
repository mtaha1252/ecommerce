<?php
include '../user/db_connection.php'; // Include the database connection

$query = "SELECT inquiry_id,  customer_name, inquiry, inquiry_date, status FROM queries ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $inquiries = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $inquiries = [];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_report_status'])) {
    $inquiryId = intval($_POST['inquiry_id']);
    $reportStatus = $_POST['report_status'] ?? 'Unreported';

    if ($inquiryId > 0) {
        $updateQuery = "UPDATE inquiries SET report_status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('si', $reportStatus, $inquiryId);
        if ($stmt->execute()) {
            echo "Report status updated successfully.";
        } else {
            echo "Failed to update report status.";
        }
        $stmt->close();
    } else {
        echo "Invalid Inquiry ID.";
    }
}
?>


<?php
include '../user/db_connection.php'; // Include the database connection

$query = "SELECT inquiry_id, customer_name, inquiry, inquiry_date, status  FROM queries ORDER BY inquiry_date DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['inquiry_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['inquiry']) . '</td>';
        echo '<td>' . htmlspecialchars($row['inquiry_date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
        echo '<td><button class="reply" data-id="' . htmlspecialchars($row['inquiry_id']) . '">Reply</button></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">No inquiries found.</td></tr>';
}
$conn->close();
?>
<?php
include '../user/db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inquiryId = intval($_POST['inquiry_id'] ?? 0);
    $response = trim($_POST['response'] ?? '');

    if ($inquiryId > 0 && !empty($response)) {
        $query = "UPDATE queries SET response = ?, status = 'Resolved', response_date = NOW() WHERE inquiry_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $response, $inquiryId);

        if ($stmt->execute()) {
            echo "Response sent successfully.";
        } else {
            echo "Failed to send response.";
        }

        $stmt->close();
    } else {
        echo "Invalid data provided.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support System</title>
    <link rel="stylesheet" href="CustomerSupport.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"> 
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
            <h2>Customer Support</h2>
        </nav>
        <div class="nav-icons">
            <div class="notifications">
                <a href=""><i class='bx bx-bell'></i></a> <!-- Notifications icon -->
                <div class="notification-dropdown not-dropdown-content">
                  <p>No new notifications</p>
                </div>
              </div>
              <div class="notifications">
                <a href=""><i class='bx bx-cog'></i></a> <!-- Settings icon -->
                <div class="notification-dropdown not-dropdown-content">
                  <p>Settings options coming soon</p>
                </div>
              </div>

            <a href="login.html"><i class='bx bx-log-out'></i></a> <!-- Logout icon -->
        </div>
    </header>

    <!-- Sidebar / Slider -->
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
        <!-- Sidebar Icons for Mobile -->
    <div class="sidebar-icons">
      <div class="notside">
        <a href=""><i class='bx bx-bell'></i>Notifications</a> 
        <div class="notSide-dropdown-content">
          <p>No Notifications</p>
        </div>
      </div>
      <div class="notside">
        <a href=""><i class='bx bx-cog'></i>Settings</a>
        <div class="notSide-dropdown-content">
          <p>Settings options coming soon</p>
        </div>
      </div>


        <a href="login.html"><i class='bx bx-log-out'></i> Logout</a>
      </div>
    </aside>

    <div class="main-content">
    <h1>Customer Inquiries</h1>

    <div class="table-container">
        <table id="inquiriesTable">
            <thead>
                <tr>
                    <th>Inquiry ID</th>
                    <th>Customer Name</th>
                    <th>Inquiry</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Report Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>


    <script src="CustomerSupport.js"></script>
</body>
</html>
