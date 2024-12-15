<?php
include '../user/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inquiryId = intval($_POST['inquiry_id']);
    $response = trim($_POST['response']);

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
}

$conn->close();
?>
