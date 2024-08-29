<?php
// reset_password.php

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
$email = $_POST['email'];
$verification_code = $_POST['verification_code'];
$new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
$user_type = $_POST['user_type']; // Assuming user_type is provided

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
        die("Invalid user type.");
}

// Verify the code
$sql = "SELECT Verification_code FROM $table WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if ($row['Verification_code'] == $verification_code) {
        // Update the password
        $sql = "UPDATE $table SET password='$new_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            echo "Your password has been reset successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Incorrect verification code.";
    }
} else {
    echo "No user found with that email.";
}

$conn->close();
?>
