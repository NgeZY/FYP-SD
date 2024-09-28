<?php
session_start();

require("config.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $email = mysqli_real_escape_string($con, $_POST['email']);
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

    $stmt = $con->prepare("SELECT * FROM $table WHERE Email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $row['Username']; 
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;
            $_SESSION['address'] = $row['Address'];
            $_SESSION['contact'] = $row['Contact'];

            // Profile photo path validation
            $profilePhotoPath = $row['Profile_photo'];

            if (!empty($profilePhotoPath)) {
                $_SESSION['profilePhoto'] = $profilePhotoPath;
            } else {
                unset($_SESSION['profilePhoto']); // Clear session variable if no photo
            }

            if ($role == 'customer') {
                header("Location: ../CG/index.php");
                exit();
            } elseif ($role == 'admin') {
                header("Location: ../AS/index.php");
			  elseif ($role == 'staff'){
				header("Location: ../AS/indexstaff.php");
                exit();
            }
			
        } else {
            echo "<script>alert('Your email or password is invalid'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        die("Prepared statement failed: " . $con->error);
    }
    $con->close();
}
?>
