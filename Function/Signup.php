<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];  // Get the user role from the form

    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Determine the table to check based on the role
    $table = ($role === "admin") ? "admin" : "customer";

    // Check if email already exists in the respective table
    $stmt = $con->prepare("SELECT Email FROM $table WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('There is already an account for this email, please try with another account.'); window.history.back();</script>";
    } else {
        // Validate admin password if the role is admin
        if ($role === "admin") {
            $adminPassword = $_POST['adminPassword'];
            $stmt = $con->prepare("SELECT Admin_password FROM Password WHERE 1"); // Assuming there's only one row in the Password table
            $stmt->execute();
            $stmt->bind_result($storedAdminPassword);
            $stmt->fetch();
            $stmt->close();

            if (!password_verify($adminPassword, $storedAdminPassword)) {
                echo "<script>alert('Wrong admin password, please try again or make sure you choose the correct identity.'); window.history.back();</script>";
                $con->close();
                exit();
            }
        }

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the insertion query
        $stmt = $con->prepare("INSERT INTO $table (Username, Password, Email, Address, Contact) VALUES (?, ?, ?, ?, ?)");
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
