<?php
function signUp() {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $item = $_POST['item'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if username or email already exists
    $qry = "SELECT * FROM customers WHERE username = ? OR email = ?";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username or Email already exists.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $qry = "INSERT INTO customers (username, password, email, item, address, contact) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($qry);
        $stmt->bind_param("ssssss", $username, $hashedPassword, $email, $item, $address, $contact);

        if ($stmt->execute()) {
            echo "Sign-up successful!";
        } else {
            echo "Error during sign-up.";
        }
    }

    $stmt->close();
    $con->close();
}
?>
