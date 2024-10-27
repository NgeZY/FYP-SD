<?php
// Database connection
require 'config.php';

// Check if form data is set
if (isset($_POST['email']) && isset($_POST['password'])) {
	$password = $_POST['password'];
	if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long.'); window.history.back();</script>";
        $con->close();
        exit();
    }
    $emailToAdd = $con->real_escape_string($_POST['email']);
    $passwordToAdd = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // SQL query to insert the new staff member
    $sql = "INSERT INTO staff (email, password) VALUES ('$emailToAdd', '$passwordToAdd')";

    if ($con->query($sql) === TRUE) {
        echo "New staff member registered successfully.";
    } else {
        echo "Error registering staff member: " . $con->error;
    }
}

// Close connection
$con->close();

// Redirect back to the previous page
header("Location: ../AS/deletestaffview.php"); // Update with your actual page
exit();
?>
