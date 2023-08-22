<?php
// Include your database connection code (config.php) here
include 'config.php';

if (isset($_POST['deleteMessages'])) {
    // SQL query to delete all messages
    $deleteQuery = "DELETE FROM message";

    if ($conn_messages->query($deleteQuery) === TRUE) {
        header("Location: view_message.php");
    } else {
        echo "Error deleting messages: " . $conn_messages->error;
        header("Location: view_message.php");
    }

    // Close the database connection
    $conn_messages->close();
}
?>
