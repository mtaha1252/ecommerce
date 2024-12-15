<?php
include '../user/db_connection.php';

$query = "SELECT inquiry_id, customer_name, inquiry, inquiry_date, status, response FROM queries ORDER BY inquiry_date DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['inquiry_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['inquiry']) . '</td>';
        echo '<td>' . htmlspecialchars($row['inquiry_date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
        echo '<td>' . (!empty($row['response']) ? htmlspecialchars($row['response']) : 'No response yet') . '</td>';
        
        // Check if a response already exists
        if (!empty($row['response'])) {
            echo '<td><button class="reply" disabled>Replied</button></td>';
        } else {
            echo '<td><button class="reply" data-id="' . htmlspecialchars($row['inquiry_id']) . '">Reply</button></td>';
        }

        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">No inquiries found.</td></tr>';
}

$conn->close();
?>
