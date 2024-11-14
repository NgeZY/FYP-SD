<?php
var_dump($_POST);

require 'config.php';

if (isset($_POST['email'])) {
    $emailToDelete = $con->real_escape_string($_POST['email']);

    // Prepare the SQL statement
    $stmt = $con->prepare("DELETE FROM staff WHERE Email = ?");
    $stmt->bind_param("s", $emailToDelete); // "s" indicates the type is string

    // Execute the statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Staff deleted successfully!'); window.location.href = '../AS/deletestaffview.php';</script>";
        } else {
            echo "<script>alert('No matching staff found.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error deleting staff member: " . htmlspecialchars($stmt->error) . "'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No staff member selected for deletion.'); window.history.back();</script>";
}

$con->close();
exit();
?>
