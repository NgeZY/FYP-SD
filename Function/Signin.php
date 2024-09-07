<?php
session_start();

include("config.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $table = '';
    if ($role == 'customer') {
        $table = 'customer';
    } elseif ($role == 'staff') {
        $table = 'staff';
    } elseif ($role == 'admin') {
        $table = 'admin';
    } else {
        die("Invalid role selected.");
    }

    $stmt = $con->prepare("SELECT * FROM $table WHERE Username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username; 
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $row['Email'];
            $_SESSION['address'] = $row['Address'];
            $_SESSION['contact'] = $row['Contact'];

            // Check if the profile photo path is not empty and the file exists
            $profilePhotoPath = $row['Profile_photo'];
            if (!empty($profilePhotoPath) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $profilePhotoPath)) {
                $_SESSION['profilePhoto'] = $profilePhotoPath;
            } else {
                unset($_SESSION['profilePhoto']); // Ensure the session variable is not set if the file does not exist
            }

            if ($role == 'customer') {
                header("Location: ../CG/index.php");
                exit();
            } elseif ($role == 'admin' || $role == 'staff') {
                header("Location: ../AS/index.html");
                exit();
            }
        } else {
            echo "<script>alert('Your Login Name or Password is invalid'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        die("Prepared statement failed: " . $con->error);
    }
    $con->close();
}
?>
