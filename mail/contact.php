<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
require'../../Function/config.php';

if ($con->connect_error) {
    echo json_encode(array("status" => "error", "message" => "Connection failed: " . $con->connect_error));
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$stmt = $con->prepare("INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)");
if ($stmt === false) {
    echo json_encode(array("status" => "error", "message" => "Prepare failed: " . $con->error));
    exit();
}
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute() === false) {
    echo json_encode(array("status" => "error", "message" => "Execute failed: " . $stmt->error));
    exit();
}

$stmt->close();
$con->close();

echo json_encode(array("status" => "success", "message" => "Feedback submitted successfully!"));
exit();
?>
