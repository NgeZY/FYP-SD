<?php
// Database connection
require 'config.php';

// Collect and sanitize form data
$name = $con->real_escape_string($_POST['name']);
$email = $con->real_escape_string($_POST['email']);
$subject = $con->real_escape_string($_POST['subject']);
$message = $con->real_escape_string($_POST['message']);

// Prepare and execute SQL statement
$sql = "INSERT INTO feedback (Name, Email, Subject, Message) VALUES ('$name', '$email', '$subject', '$message')";

if ($con->query($sql) === TRUE) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

// Close connection
$con->close();
?>
