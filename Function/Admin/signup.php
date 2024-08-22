<?php
function signUp() {
    // Start session
    session_start();

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Connect to database
    $con = new mysqli("localhost", "root", "", "utmadvance");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if username or email already exists
    $qry = "SELECT * FROM users WHERE username = ? OR email = ?";
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
        $qry = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $con->prepare($qry);
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "Sign-up successful!";
        } else {
            echo "Error during sign-up.";
        }
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
}