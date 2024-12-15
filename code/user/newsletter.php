<?php

include 'db_connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM news_letter WHERE email = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Database error: Unable to prepare statement.']);
            exit();
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'This email is already subscribed!']);
            exit();
        } else {
            $insertQuery = "INSERT INTO news_letter (email) VALUES (?)";
            $stmt = $conn->prepare($insertQuery);
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Database error: Unable to prepare statement.']);
                exit();
            }
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                sendSubscriptionEmail($email);
                echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Could not save your subscription.']);
                exit();
            }
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email format!']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    
}

$conn->close();



function sendSubscriptionEmail($recipientEmail)
{
    $subject = "Thank You for Subscribing!";
    $body = "Dear Subscriber,<br><br>Thank you for subscribing to our newsletter. Stay tuned for exciting updates.<br><br>Best Regards";
    $senderEmail = "hifzaamir618@gmail.com";
    $senderName = "Shapag Gang";

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hifzaamir618@gmail.com';
    $mail->Password = 'bxssmrpnrizxccyg';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($senderEmail, $senderName);
    $mail->addAddress($recipientEmail);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;

    return $mail->send();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="newsletter.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>

    <div id="newsletter-popup">
        <button id="close-popup" onclick="closePopup()">x</button>
        <h3>Join Our Newsletter!</h3>
        <p>Subscribe to receive the latest updates and offers.</p>
        <form id="newsletter-form" action="subscribe_newsletter.php" method="POST">
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </div>
    <script src="newsletter.js"></script>
</body>

</html>