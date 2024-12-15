<?php include '../user/db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support System</title>
    <link rel="stylesheet" href="CustomerSupport.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="menu-toggle"><i class='bx bx-menu'></i></div>
        <div class="logo"><img src="logo.png" alt="Logo"></div>
        <nav class="navbar"><h2>Customer Support</h2></nav>
        <div class="nav-icons">
            <a href="#"><i class='bx bx-bell'></i></a>
            <a href="#"><i class='bx bx-cog'></i></a>
            <a href="login.html"><i class='bx bx-log-out'></i></a>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <ul>
            <li><a href="dashboard.html"><i class='bx bx-user'></i> Dashboard</a></li>
            <li><a href="CustomerSupport.html"><i class='bx bx-headphone'></i> Customer Support</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
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
                        <th>Response</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be loaded dynamically here -->
                </tbody>
            </table>
        </div>

        <!-- Reply Form -->
        <div id="replySection">
            <h2>Respond to Inquiry</h2>
            <form id="supportForm">
                <input type="hidden" id="inquiryId" name="inquiry_id">
                <textarea id="response" name="response" placeholder="Type your response..." required></textarea>
                <button type="submit">Send Response</button>
            </form>
        </div>
    </div>

    <script src="customer_support.js"></script>
</body>
</html>
