<?php
include '../user/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directories
    $uploadsDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0777, true);

    // Form Inputs
    $title = trim($_POST['collection_title']);
    $description = trim($_POST['collection_description']);
    $videoUrl = trim($_POST['video_url']);
    $mainImagePath = '';
    $collectionImagePath = '';

    // Upload Main Image
    if (!empty($_FILES['main_image']['name'])) {
        $mainImageName = time() . '_main_' . basename($_FILES['main_image']['name']);
        $mainImagePath = 'uploads/' . $mainImageName;
        move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadsDir . $mainImageName);
    }

    // Upload Collection Image
    if (!empty($_FILES['collection_image']['name'])) {
        $collectionImageName = time() . '_collection_' . basename($_FILES['collection_image']['name']);
        $collectionImagePath = 'uploads/' . $collectionImageName;
        move_uploaded_file($_FILES['collection_image']['tmp_name'], $uploadsDir . $collectionImageName);
    }

    // Insert into DB
    if ($title && $description && $mainImagePath && $collectionImagePath && $videoUrl) {
        $query = "INSERT INTO new_arrivals (main_image, video_url, collection_title, collection_description, collection_image)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $mainImagePath, $videoUrl, $title, $description, $collectionImagePath);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch Records
$result = $conn->query("SELECT * FROM new_arrivals ORDER BY added_date DESC");
$newArrivals = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Arrivals - Admin</title>
    <link rel="stylesheet" href="add.css"> <!-- Existing CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Arial", sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #6c757d;
        }

        .main-content {
            width: 90%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-container {

            margin-top: 100px;
        }

        table, th, td {
    border: 1px solid rgb(194, 40, 40); 
    padding: 12px;
    text-align: center;
    font-size: 16px;
    color: #333;
}

th {
    background-color: maroon;
    color: white;
    font-weight: bold;
    font-size: 18px;
    text-transform: uppercase;
}

td {
    background-color: #fefefe;
    color: #333;
    padding: 15px;
    font-size: 16px;
}

tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
}

tbody tr {
    transition: background-color 0.3s ease; 
}

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
            transition: background-color 0.3s ease;
        }

        .table-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-view {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 10px;
            }

            .btn {
                font-size: 12px;
                padding: 5px 8px;
            }
        }
    </style>

</head>
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
            <h2>Manage New Arrivals</h2>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <ul>
            <li><a href="dashboard.html"><i class='bx bx-user'></i> Dashboard</a></li>
            <li><a href="new_arrivals_admin.php"><i class='bx bx-box'></i> New Arrivals</a></li>
            <li><a href="stock.html"><i class='bx bx-package'></i> Stock Management</a></li>
            <li><a href="orders.html"><i class='bx bx-cart'></i> Orders</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Add New Arrival</h1>
        <form id="addNewArrivalForm" action="new_arrivals.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label>Main Image (Background):</label>
                <input type="file" name="main_image" accept="image/*" required>
            </div>
            <div class="input-group">
    <label>Video Link (URL):</label>
    <input type="url" name="video_url" placeholder="Paste Video Link" required>
</div>
            <div class="input-group">
                <label>Collection Title:</label>
                <input type="text" name="collection_title" placeholder="Enter Collection Title" required>
            </div>
            <div class="input-group">
                <label>Collection Description:</label>
                <textarea name="collection_description" rows="4" placeholder="Enter Description" required></textarea>
            </div>
            <div class="input-group">
                <label>Collection Image:</label>
                <input type="file" name="collection_image" accept="image/*" required>
            </div>
            <button type="submit">Add New Arrival</button>
        </form>

       <!-- Table -->
    <table>
        <tr>
            <th>ID</th><th>Main Image</th><th>Video URL</th><th>Title</th><th>Description</th><th>Collection Image</th><th>Actions</th>
        </tr>
        <?php foreach ($newArrivals as $arrival): ?>
        <tr>
            <td><?= $arrival['id'] ?></td>
            <td><?= basename($arrival['main_image']) ?></td>
            <td><?= basename($arrival['video_url']) ?></td>
            <td><?= $arrival['collection_title'] ?></td>
            <td><?= $arrival['collection_description'] ?></td>
            <td><?= basename($arrival['collection_image']) ?></td>
            <td>
                <form method="POST" action="delete_arrival.php" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $arrival['id'] ?>">
                    <button type="submit" onclick="return confirm('Are you sure?');">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
        </div>
    </div>
    <script>
        document.querySelector('.menu-toggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('sidebar-open');
        });
    </script>
</body>
</html>
