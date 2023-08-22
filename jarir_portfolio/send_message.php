<?php
// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $senderName = $_POST['name'];
    $senderEmail = $_POST['email'];
    $message = $_POST['message'];
    $date = date("Y-m-d");
    $time = date("H:i:s");

    // Handle storing messages in a MySQL database
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "messages";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO message (name, email, message, date, time) VALUES ('$senderName', '$senderEmail', '$message', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Message Sent successfully";
    } else {
        echo "Message Sending Failed";
    }

    $conn->close();
} else {
    // If the request is not POST, return an error
    echo "Invalid request method";
}
?>
