<?php
session_start();
echo "Session ID: " . session_id(); 

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
            header("Location: mainpage.php");
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Add your CSS file here -->
</head>
<body>
    <div class="login-container">
        <h2>Sign In</h2>
        <form action="Signin.php" method="post">
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="customer">Customer</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign In</button>
        </form>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
    </div>
</body>
</html>
