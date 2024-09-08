<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utmadvance";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

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
