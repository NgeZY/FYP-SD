<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword']; // Get the confirm password from the form
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];  // Get the user role from the form

    $con = new mysqli("localhost", "root", "", "utmadvance");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.history.back();</script>";
        $con->close();
        exit();
    }

    // Check if email already exists in the pending_verification or role table
    $stmt = $con->prepare("SELECT Email FROM pending_verification WHERE Email = ? UNION SELECT Email FROM admin WHERE Email = ? UNION SELECT Email FROM customer WHERE Email = ?");
    $stmt->bind_param("sss", $email, $email, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('There is already an account for this email, please try with another account.'); window.history.back();</script>";
        $stmt->close();
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate a verification token
        $token = bin2hex(random_bytes(16));

        // Insert the data into the `pending_verification` table
        $stmt->close();
        $stmt = $con->prepare("INSERT INTO pending_verification (Username, Password, Email, Address, Contact, Role, verification_token) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $hashed_password, $email, $address, $contact, $role, $token);

        if ($stmt->execute()) {
            // Send verification email
            require '../vendor/autoload.php'; // Path to Composer's autoload file
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'zheyunge041225@gmail.com'; // Use environment variable for SMTP username
            $mail->Password = 'dokr kpme kmaz wtnr'; // Use environment variable for SMTP password
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
                // Output detailed PHPMailer error info
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
