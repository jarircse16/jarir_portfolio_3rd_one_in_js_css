<?php
// Start the session
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit();
}

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "messages";

// Attempt to connect to the database
$conn_messages = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if ($conn_messages->connect_error) {
    die("Connection failed: " . $conn_messages->connect_error);
}

$sql = "SELECT name, email, message, date, time FROM message";
$result = $conn_messages->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/background.css">
    <link rel="stylesheet" href="assets/css/background.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/redglow.css">
    <link rel="stylesheet" href="assets/css/glow.css">
    <link rel="stylesheet" href="assets/css/slideshow.css">
    <link rel="stylesheet" href="assets/css/stylish.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <title>View Messages</title>
</head>
<body style="background-image: url('assets/img/1200px-Access-granted.png'); background-repeat: no-repeat; background-size: cover;">
  <center><div class="glow-text"><h2>View Messages</h2>
    <br>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <br>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th><th>Time</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['message']}</td><td>{$row['date']}</td><td>{$row['time']}</td></tr>";
        }
        echo "</table>";
    } else {

        echo '<br>';
        echo "No messages found.";
    }

    $conn_messages->close();
    ?>

    <br>
    <center><div class="contact__buttons">
      <div style="text-align: center;" class="contact__buttons">
    <center><a href="logout.php"><input type="submit" value="Logout" class="contact__button button contact__buttonsx">
    </a>  <!-- Provide a link to log out -->
</body>
</html>
