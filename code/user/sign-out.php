<?php
session_start();

// Destroy the session and all session data
session_destroy();

// Optionally, unset individual session variables before destroying the session
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['email']);

// Redirect user to the login page (or elsewhere)
header('Location: sign-in.php');
exit();
?>
