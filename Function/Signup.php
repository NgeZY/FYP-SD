<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];

    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if any required field is empty
    if (empty($username) || empty($password) || empty($confirmPassword) || empty($email) || empty($role)) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        $con->close();
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.history.back();</script>";
        $con->close();
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please try again.'); window.history.back();</script>";
        $con->close();
        exit();
    }

    // Validate contact number (optional)
    if (!empty($contact) && !is_numeric($contact)) {
        echo "<script>alert('Invalid contact number. Please enter a valid number.'); window.history.back();</script>";
        $con->close();
        exit();
    }

    // Check password length
    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long.'); window.history.back();</script>";
        $con->close();
        exit();
    }

    // Check if email already exists in any table
    $stmt = $con->prepare("SELECT Email FROM pending_verification WHERE Email = ? UNION SELECT Email FROM admin WHERE Email = ? UNION SELECT Email FROM customer WHERE Email = ?");
    $stmt->bind_param("sss", $email, $email, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('There is already an account for this email, please try with another account.'); window.history.back();</script>";
        $stmt->close();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(16));

        $stmt->close();
        $stmt = $con->prepare("INSERT INTO pending_verification (Username, Password, Email, Address, Contact, Role, verification_token) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $hashed_password, $email, $address, $contact, $role, $token);

        if ($stmt->execute()) {
            require '../vendor/autoload.php'; 
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'zheyunge041225@gmail.com'; 
            $mail->Password = 'dokr kpme kmaz wtnr'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('no-reply@gmail.com', 'UTM Advance');
            $mail->addAddress($email);

            $mail->Subject = 'Verify your email';
            $mail->Body    = "Please click the link below to verify your email address:
http://localhost/FYP-SD/Function/verify.php?token=$token&role=$role";

            if ($mail->send()) {
                echo "<script>alert('A verification link has been sent to your email.'); window.location.href = '../CG/Signinform.php';</script>";
            } else {
                echo "<script>alert('Verification email could not be sent. Error: " . $mail->ErrorInfo . "'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
        }
    }

    $stmt->close();
    $con->close();
}
?>