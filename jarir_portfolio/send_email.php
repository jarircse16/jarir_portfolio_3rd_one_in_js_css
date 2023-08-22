<?php
// IP-based rate limiting code here to prevent email bombing
error_reporting(0);
//error_reporting(1);

// Spoof the sender's email and set the recipient (admin's email)
$senderEmail = "random_user@random_domain"; // Spoofed sender
$recipientEmail = "jarircse16@gmail.com"; // Admin's email

$subject = "Subject of the Email";
$message = "This is the email message content.";

// Send the email
$headers = "From: $senderEmail" . "\r\n";
if (mail($recipientEmail, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed!";
}
?>
