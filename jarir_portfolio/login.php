<?php
// Start the session
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['username'])) {
    header("Location: view_messages.php"); // Redirect to the view_messages.php page if already authenticated
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database authentication
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "messages"; // Replace with the name of your authentication database

    // Attempt to connect to the database
    $conn_auth = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($conn_auth->connect_error) {
        die("Authentication connection failed: " . $conn_auth->connect_error);
    }

    // Perform the authentication query
    $auth_query = "SELECT * FROM auth_user WHERE username = '$username' AND password = '$password'";
    $auth_result = $conn_auth->query($auth_query);

    if ($auth_result->num_rows === 1) {
        // User is authenticated
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: view_message.php");
        exit();
    }

    $conn_auth->close();

    // Text file authentication as a fallback
    $textFileContents = file_get_contents('auth.txt');
    $credentials = explode(":", $textFileContents);

    $fileUsername = trim($credentials[0]);
    $filePassword = trim($credentials[1]);

    if ($username === $fileUsername && $password === $filePassword) {
        // User is authenticated using the text file
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: view_message.php");
        exit();
    } else {
        $loginError = "Authentication failed. Please check your username and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/background.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/redglow.css">
    <link rel="stylesheet" href="assets/css/glow.css">
    <link rel="stylesheet" href="assets/css/slideshow.css">
    <link rel="stylesheet" href="assets/css/stylish.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <title>Admin Panel</title>
    <style>
    /* Custom CSS for mobile responsiveness */
    @media (max-width: 768px) {
        body {
            background-size: cover;
        }
        .glow-text {
            font-size: 24px;
        }
        /* mobile.css */
body {
    background-size: cover;
}

.glow-text {
    font-size: 24px;
    margin-top: 20px; /* Increase top margin for better spacing on small screens */
}

/* Style form elements for better spacing */
label {
    display: block; /* Place labels on top of input fields */
    font-size: 18px; /* Reduce label font size for smaller screens */
    margin-bottom: 10px; /* Add spacing below labels */
}

input[type="text"],
input[type="password"] {
    width: 100%; /* Make input fields full-width */
    padding: 10px; /* Increase padding for touch-friendly inputs */
    font-size: 16px; /* Reduce input font size for smaller screens */
    margin-bottom: 15px; /* Add spacing below input fields */
}

.contact__button.button {
    width: 100%; /* Make the Login button full-width */
    font-size: 18px; /* Adjust button font size for smaller screens */
    margin-top: 20px; /* Increase top margin for better spacing */
}

/* Style the "Go Back" button for better visibility on small screens */
.contact__button.button.contact__buttonsx {
    font-size: 18px; /* Adjust font size */
    padding: 10px 20px; /* Increase padding for touch-friendly button */
    margin-top: 20px; /* Increase top margin for better spacing */
    /* mobile.css */
body {
    background-size: contain; /* Make the background image fit within the viewport */
    background-repeat: no-repeat;
    background-position: center center;
}

/* Adjust the size of the background image for smaller screens */
@media screen and (max-width: 768px) {
    body {
        background-size: cover; /* Revert to cover for larger screens */
    }
}

/* Reduce spacing for smaller screens */
.glow-text {
    font-size: 24px;
    margin-top: 10px; /* Reduce top margin for smaller screens */
}

/* Style form elements for better spacing */
label {
    display: block;
    font-size: 18px;
    margin-bottom: 10px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    margin-bottom: 15px;
}

/* Make the Login button full-width and match input boxes */
.contact__button.button {
    width: 100%;
    font-size: 16px; /* Adjust button font size for smaller screens */
    padding: 10px; /* Match padding with input fields */
    margin-top: 10px; /* Reduce top margin for better alignment */
}

/* Style the "Go Back" button */
.contact__button.button.contact__buttonsx {
    font-size: 16px;
    padding: 10px;
    margin-top: 10px;
}

/* Adjust button width for larger screens */
@media screen and (min-width: 769px) {
    .contact__button.button,
    .contact__button.button.contact__buttonsx {
        width: auto; /* Allow buttons to take their content's width */
    }
}

}

    }
</style>
</head>
<body style="background-image: url('assets/img/admin.png'); background-repeat: no-repeat; background-size: cover;">
    <div class="glow-text"><center><h2>Admin Panel</h2></div>
      <br>
    <?php
    if (isset($loginError)) {
        echo '<p style="color: red;">' . $loginError . '</p>';
    }
    ?>
    <form method="post" action="">
        <center><label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit"  class="contact__button button" value="Login">
    </form>
  </center>
    <br>
    <center><div class="contact__buttons">
      <div style="text-align: center;">
  <a href="index.html"> <input type="submit" value="Go Back" class="contact__button button contact__buttonsx">
    </a>
  </div>

    </div>
</body>
</html>
