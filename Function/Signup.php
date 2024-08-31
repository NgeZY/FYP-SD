<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $role = $_POST['role']; 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
	$address = $_POST['address'];
    $contact = $_POST['contact'];

    
    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    
    $stmt = $con->prepare("SELECT Username FROM customer WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $con->prepare("INSERT INTO customer (Username, Password, Email, Address, Contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $hashed_password, $email, $address, $contact);

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