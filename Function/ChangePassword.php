<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    die("<script>alert('Session expired or invalid. Please sign in again.'); window.location.href = '../CG/Signinform.php';</script>");
}

$username = $_SESSION['username'];
$OPassword = $_POST['current_password'];
$NPassword = $_POST['new_password'];
$NPassword2 = $_POST['confirm_password'];

// Assuming user type is stored in the session
$user_type = $_SESSION['role'];

$con = new mysqli("localhost", "root", "", "utmadvance");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Determine the table based on user type
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

// Prepare and execute query to get the stored password hash
$qry = "SELECT Password FROM $table WHERE Username = ?";
$stmt = $con->prepare($qry);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($stored_password);
$stmt->fetch();
$stmt->close();

if ($stored_password === null) {
    echo "<script>alert('The username you entered does not exist.'); window.history.back();</script>";
} else if (!password_verify($OPassword, $stored_password)) {
    echo "<script>alert('You entered an incorrect password.'); window.history.back();</script>";
} else {
    if ($NPassword === $NPassword2) {
        // Hash the new password
        $hashed_new_password = password_hash($NPassword, PASSWORD_BCRYPT);

        $updateQry = "UPDATE $table SET Password = ? WHERE Username = ?";
        $stmt = $con->prepare($updateQry);
        $stmt->bind_param("ss", $hashed_new_password, $username);
        
        if ($stmt->execute()) {
			if($user_type == 'customer')
				echo "<script>alert('Password changed successfully.'); window.location.href = '../AS/Profile.php';</script>";
			else if($user_type == 'staff' || $user_type == 'admin')
				echo "<script>alert('Password changed successfully.'); window.location.href = '../AS/ProfileAS.php';</script>";
        } else {
            echo "<script>alert('Error updating password.'); window.history.back();</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('New passwords do not match.'); window.history.back();</script>";
    }
}

$con->close();
?>
