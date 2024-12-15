<?php
include '../user/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restock / Unstock Products</title>
    <link rel="stylesheet" href="stock.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <h1>Restock or Unstock Products</h1>
        <div class="table-container">
            <table id="productsTable" border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT product_id, product_name, product_stock FROM products";
                    $result = $conn->query($query);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['product_id']}</td>
                            <td>{$row['product_name']}</td>
                            <td class='stock'>{$row['product_stock']}</td>
                            <td>
                                <input type='number' class='restock-qty' data-id='{$row['product_id']}' placeholder='Qty' min='1'>
                                <button class='restock' data-id='{$row['product_id']}'>Restock</button>
                                <button class='unstock' data-id='{$row['product_id']}'>Unstock</button>
                            </td>
                        </tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="stock_.js"></script>
</body>
</html>
