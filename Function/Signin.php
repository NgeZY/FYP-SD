<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $role = $_POST['role'];  
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    
    $table = '';
    if ($role === 'customer' || $role === 'staff' || $role === 'admin') {
        $table = $role;
    } else {
        echo "Invalid role selected.";
        exit;
    }

   
    $stmt = $con->prepare("SELECT Password FROM $table WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();

   
    if ($stored_password && password_verify($password, $stored_password)) {
      
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        echo "Sign-in successful! Welcome, " . $username . ". You are logged in as " . $role . ".";
       
    } else {
        echo "Incorrect username or password.";
    }

    $con->close();
}
?>