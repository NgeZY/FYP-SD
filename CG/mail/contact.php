<?php
header('Content-Type: text/plain'); // Set content type to plain text

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utmadvance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Respond with a generic error message
    echo 'Something went wrong... Please try again.';
    exit();
}

// Sanitize inputs
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)");
if ($stmt === false) {
    // Respond with a generic error message
    echo 'Something went wrong... Please try again.';
    exit();
}
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute the statement
if ($stmt->execute() === false) {
    // Respond with a generic error message
    echo 'Something went wrong... Please try again.';
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Respond with a success message
echo 'Feedback submitted successfully!';
exit();
?>
