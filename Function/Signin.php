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
            header("Location: ../CG/index.php");
            exit();
        } else {
            $error = "Your Login Name or Password is invalid";
        }

        $stmt->close();
    } else {
        die("Prepared statement failed: " . $con->error);
    }
    $con->close();
}
?>
