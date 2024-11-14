<?php
// Database connection
require 'config.php';

// Check if username is set
if (isset($_POST['username'])) {
    $usernameToDelete = $con->real_escape_string($_POST['username']);

    // SQL query to delete the customer
    $sql = "DELETE FROM customer WHERE username='$usernameToDelete'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Customer deleted successfully!'); window.location.href = '../AS/deletecustomerview.php';</script>";
    } else {
        echo "<script>alert('Error deleting customer: " . $con->error . "'); window.history.back();</script>";
    }
}

// Close connection
$con->close();

// Redirect back to the previous page
header("Location: ../AS/deletecustomerview.php"); // Update with your actual page
exit();
?>
