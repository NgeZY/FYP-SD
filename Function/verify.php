<?php
if (isset($_GET['token']) && isset($_GET['role'])) {
    $token = $_GET['token'];
    $role = $_GET['role'];

    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if the token exists in the `pending_verification` table
    $stmt = $con->prepare("SELECT Username, Password, Email, Address, Contact FROM pending_verification WHERE verification_token = ? AND Role = ?");
    $stmt->bind_param("ss", $token, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $username = $row['Username'];
        $password = $row['Password'];
        $email = $row['Email'];
        $address = $row['Address'];
        $contact = $row['Contact'];

        // Insert data into the final `admin` or `customer` table
        $table = ($role === "admin") ? "admin" : "customer";
        $stmt->close();
        $stmt = $con->prepare("INSERT INTO $table (Username, Password, Email, Address, Contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $email, $address, $contact);

        if ($stmt->execute()) {
            // Delete from `pending_verification`
            $stmt->close();
            $stmt = $con->prepare("DELETE FROM pending_verification WHERE verification_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            echo "<script>
                alert('Your email has been verified! You can now sign in.');
                window.location.href = '../CG/Signinform.php';
            </script>";
        } else {
            // Delete from `pending_verification` if error occurs in inserting into final table
            $stmt->close();
            $stmt = $con->prepare("DELETE FROM pending_verification WHERE verification_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            echo "<script>
                alert('Error inserting into the final table. Please sign up again.');
                window.location.href = '../CG/Signupform.php';
            </script>";
        }
    } else {
        // Delete from `pending_verification` if token is invalid or expired
        $stmt->close();
        $stmt = $con->prepare("DELETE FROM pending_verification WHERE verification_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo "<script>
            alert('Invalid or expired token.');
            window.location.href = '../CG/Signupform.php';
        </script>";
    }

    $stmt->close();
    $con->close();
} else {
    echo "<script>
        alert('Invalid request.');
        window.history.back();
    </script>";
}
?>
