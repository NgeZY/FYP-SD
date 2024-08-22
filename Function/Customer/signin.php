<?php
function signIn() {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $qry = "SELECT id, username, password FROM customers WHERE username = ?";
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

    $stmt->close();
    $con->close();
}
?>
