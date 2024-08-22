<?php
function signIn() {
    // Start session
    session_start();

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    $con = new mysqli("localhost", "root", "", "utmadvance");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Query to check the user
    $qry = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $stored_username, $stored_password);
    $stmt->fetch();

    if ($stored_username === null) {
        echo "The username you entered does not exist.";
    } elseif (password_verify($password, $stored_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $stored_username;
        echo "Sign-in successful! Welcome, " . $stored_username;
    } else {
        echo "Incorrect password.";
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
}