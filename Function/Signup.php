<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
	$address = $_POST['address'];
    $contact = $_POST['contact'];

    
    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    
    $stmt = $con->prepare("SELECT Email FROM customer WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('There is already an account for this email, please try with another account.'); window.history.back();</script>";
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $con->prepare("INSERT INTO customer (Username, Password, Email, Address, Contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $hashed_password, $email, $address, $contact);

        if ($stmt->execute()) {
            echo "<script>alert('Sign-up successful! You can now sign in.'); window.location.href = '../CG/Signinform.html';</script>";
            
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
        }
    }

    $stmt->close();
    $con->close();
}
?>