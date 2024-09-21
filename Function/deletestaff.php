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

// Check if username is set
if (isset($_POST['username'])) {
    $usernameToDelete = $con->real_escape_string($_POST['username']);

    // SQL query to delete the staff member
    $sql = "DELETE FROM staff WHERE username='$usernameToDelete'";

    if ($con->query($sql) === TRUE) {
        echo "Staff member deleted successfully.";
    } else {
        echo "Error deleting staff member: " . $con->error;
    }
}

// Close connection
$con->close();

// Redirect back to the previous page
header("Location: ../AS/deletestaffview.php"); // Update with your actual page
exit();
?>
