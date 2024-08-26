<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $role = $_POST['role']; 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    
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

    
    $stmt = $con->prepare("SELECT Username FROM $table WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       
        if ($role === 'customer') {
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $stmt = $con->prepare("INSERT INTO $table (Username, Password, Email, Address, Contact) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $hashed_password, $email, $address, $contact);
        } else {
            $stmt = $con->prepare("INSERT INTO $table (Username, Password, Email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $email);
        }

        if ($stmt->execute()) {
            echo "Sign-up successful! You can now sign in.";
            
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $con->close();
}
?>