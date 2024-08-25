<?php
session_start();

$username = $_POST['username'];
$OPassword = $_POST['current_password'];
$NPassword = $_POST['new_password'];
$NPassword2 = $_POST['password_confirm'];

$con = new mysqli("localhost", "root", "", "utmadvance");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$qry = "SELECT Password FROM admin WHERE Username = ?";
$stmt = $con->prepare($qry);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($stored_password);
$stmt->fetch();
$stmt->close();

if ($stored_password === null) {
    echo "The username you entered does not exist.";
} else if ($OPassword !== $stored_password) {
    echo "You entered an incorrect password.";
} else {
    if ($NPassword === $NPassword2) {
        $updateQry = "UPDATE admin SET Password = ? WHERE Username = ?";
        $stmt = $con->prepare($updateQry);
        $stmt->bind_param("ss", $NPassword, $username);
        
        if ($stmt->execute()) {
            echo "Password changed successfully.";
        } else {
            echo "Error updating password.";
        }
        
        $stmt->close();
    } else {
        echo "New passwords do not match.";
    }
}

$con->close();
?>
