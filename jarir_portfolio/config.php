<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "messages";

// Attempt to connect to the database
$conn_messages = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if ($conn_messages->connect_error) {
    die("Connection failed: " . $conn_messages->connect_error);
}
?>
