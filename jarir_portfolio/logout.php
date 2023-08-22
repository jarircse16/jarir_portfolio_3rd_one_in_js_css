<?php
// Start the session
session_start();

// Check if the user is authenticated
if (isset($_SESSION['username'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page (or any other desired page)
    header("Location: login.php");
    exit();
} else {
    // If the user is not authenticated, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
