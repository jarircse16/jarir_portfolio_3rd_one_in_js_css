<?php
// Database connection information
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "messages";

// User data to insert
$username = "admin"; // Replace with the desired username
$password = "5f4dcc3b5aa765d61d8327deb882cf99"; // Replace with the hashed password (you should hash the password for security)

// Create a database connection
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to insert data into the auth_user table
$sql = "INSERT INTO auth_user (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
