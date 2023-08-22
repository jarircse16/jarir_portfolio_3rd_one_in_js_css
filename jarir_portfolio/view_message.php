<?php
// Start the session
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit();
}
?>

<?php include 'config.php'; ?>

<?php

$sql = "SELECT name, email, message, date, time FROM message";
$result = $conn_messages->query($sql);

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/background.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/redglow.css">
    <link rel="stylesheet" href="assets/css/glow.css">
    <link rel="stylesheet" href="assets/css/slideshow.css">
    <link rel="stylesheet" href="assets/css/stylish.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
    $("#deleteButton").click(function(event) {
        event.preventDefault();
        // Your AJAX code here
    });
  });
  </script>
<?php
  // Check if the welcome message has been shown
  if (!isset($_SESSION['welcome_message_shown'])) {
      $_SESSION['welcome_message_shown'] = true;
      $showWelcomeMessage = true;
  } else {
      $showWelcomeMessage = false;
  }
  ?>

  <!--  <link rel="stylesheet" href="assets/css/responsive.css">-->

    <title>View Messages</title>
</head>
<body style="background-image: url('assets/img/1200px-Access-granted.png'); background-repeat: no-repeat; background-size: cover;">
  <div class="glow-text"><center><h2>View Messages</h2>
    <br>
    <?php if ($showWelcomeMessage) { ?>
            <!-- JavaScript to show the welcome alert -->
            <script>
                // Use JavaScript to show a welcome alert
                window.onload = function () {
                    var welcomeMessage = "Welcome to Admin Panel!";
                    alert(welcomeMessage);
                };
            </script>
        <?php } ?>
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
    <div class="contact__buttons">
      <div style="text-align: center;">
        <a href="logout.php"><input type="submit" value="Logout" class="contact__button button contact__buttonsx" onclick="showMessage()"></a>
      </div>
    </div>

    <script>
      function showMessage() {
      alert('Good Bye');
        }
    </script>
    
    <div style="text-align: center; margin-top: 20px;">


               <form action="delete_messages.php" method="post" class="contact__form" id="messageForm">
                    <input type="submit" name="deleteMessages" value="Delete All Messages" class="contact__button button" onclick="showAlert()">
                </form>
                <div id="response"></div>

                <script>
                  function showAlert() {
                  alert('Deleted Successfully');
                    }
                </script>

            </div>
  </center>
</div>
<script src=assets/js/delete.js>
</body>
</html>

<?php
// Check if a message parameter is present in the URL
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
    echo $message;
}
?>
