<?php
session_start();
// reset_password.php

if (!isset($_SESSION['email']) || !isset($_SESSION['user_type'])) {
    die("<script>alert('Session expired or invalid. Please try again.'); window.location.href = '../CG/Forgotpasswordform.php';</script>");
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utmadvance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate input
$email = $_SESSION['email'];
$verification_code = $_POST['verification_code'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$user_type = $_SESSION['user_type']; // Assuming user_type is provided

// Check if passwords match
if ($new_password !== $confirm_password) {
    die("<script>alert('Passwords do not match.'); window.history.back();</script>");
}

// Check if the new password is at least 8 characters long
if (strlen($new_password) < 8) {
    die("<script>alert('New password must be at least 8 characters long.'); window.history.back();</script>");
}

// Hash the new password
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

// Determine the correct table based on user_type
switch ($user_type) {
    case 'admin':
        $table = 'admin';
        break;
    case 'customer':
        $table = 'customer';
        break;
    case 'staff':
        $table = 'staff';
        break;
    default:
        die("<script>alert('Invalid user type.'); window.history.back();</script>");
}

// Verify the code
$sql = "SELECT Verification_code FROM $table WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if ($row['Verification_code'] == $verification_code) {
        // Update the password
        $sql = "UPDATE $table SET password='$hashed_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Your password has been reset successfully."); window.location.href = "../CG/Signinform.php";</script>';
        } else {
            echo "<script>alert('Error updating password: " . $conn->error . "'); window.history.back();</script>";
        }
    } else {
        echo '<script>alert("Incorrect verification code."); window.history.back();</script>';
    }
} else {
    echo '<script>alert("No user found with that email."); window.history.back();</script>';
}

$conn->close();
session_unset(); // Remove all session variables
session_destroy();
?>
