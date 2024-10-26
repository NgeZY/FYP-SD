<?php
// send_verification_code.php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to Composer's autoload file

// Database connection
require 'config.php';

$email = $con->real_escape_string($_POST['email']);
$user_type = $con->real_escape_string($_POST['user_type']); // Sanitize user_type

// Determine the table based on user type
switch ($user_type) {
    case 'admin':
        $table = 'admin';
        break;
    case 'customer':
        $table = 'customer';
        break;
    case 'staff':
        $table = 'staff';
        break;
    default:
        die("Invalid user type.");
}

$_SESSION['user_type'] = $user_type;
$_SESSION['email'] = $email;

// Check if the email exists in the table
$stmt = $con->prepare("SELECT COUNT(*) FROM $table WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    // Generate a random verification code
    $verification_code = rand(100000, 999999);

    // Prepare an SQL statement to update the verification code
    $stmt = $con->prepare("UPDATE $table SET Verification_code=? WHERE email=?");
    $stmt->bind_param("is", $verification_code, $email);

    if ($stmt->execute()) {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
            $mail->Username = 'zheyunge041225@gmail.com'; // SMTP username
            $mail->Password = 'dokr kpme kmaz wtnr'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('no-reply@gmail.com', 'UTM Advance');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Verification Code';
            $mail->Body = 'Your verification code for account ' . $email . ' for UTM Advance is: <b>' . $verification_code . '</b>';

            $mail->send();
            echo "A verification code has been sent to your email.";
			header("Location: ../CG/Verifycodeform.php");
			exit;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error updating record: " . $stmt->error;
    }
	$stmt->close();
	
} else {
    echo "The email address is not registered.";
}

// Close connections
$con->close();
?>
