<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utmadvance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error));
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$stmt = $conn->prepare("INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)");
if ($stmt === false) {
    echo json_encode(array("status" => "error", "message" => "Prepare failed: " . $conn->error));
    exit();
}
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute() === false) {
    echo json_encode(array("status" => "error", "message" => "Execute failed: " . $stmt->error));
    exit();
}

$stmt->close();
$conn->close();

echo json_encode(array("status" => "success", "message" => "Feedback submitted successfully!"));
exit();
?>
