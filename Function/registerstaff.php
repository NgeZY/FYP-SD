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

// Check if form data is set
if (isset($_POST['email']) && isset($_POST['password'])) {
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