<?php
ob_start();
session_start();
ob_end_flush();

require 'config.php'; // Include your database connection

if (!isset($_SESSION['role']) || !isset($_SESSION['email'])) {
    die("<script>alert('Session expired or invalid. Please sign in again.'); window.location.href = '../CG/Signinform.php';</script>");
}

if (isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $role = $_SESSION['role']; // Get the user's role from the session
    $current_email = $_SESSION['email']; // Current email from session
    $current_page = "../AS/Profile.php";

    // Validate and sanitize inputs
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $contact_number = filter_var($contact_number, FILTER_SANITIZE_STRING);

    // Check if the email is valid
    if (!$email) {
        echo "<script>alert('Invalid email format.'); window.location.href = '$current_page';</script>";
        exit;
    }

    // Check if the new email is already in use by another user
    $table = '';
    switch ($role) {
        case 'admin':
            $table = 'admin';
            break;
        case 'staff':
            $table = 'staff';
            break;
        case 'customer':
            $table = 'customer';
            break;
        default:
            echo "<script>alert('Invalid role.'); window.location.href = '$current_page';</script>";
            exit;
    }

    // Query to check for existing email
    $checkEmailSQL = "SELECT email FROM $table WHERE email = ? AND email != ?";
    $stmt = $con->prepare($checkEmailSQL);
    $stmt->bind_param('ss', $email, $current_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
				alert('Email is already in use by another user.');
				window.location.href = '$current_page';
			  </script>";
        $stmt->close();
        $con->close();
        exit;
    }
    $stmt->close();

    // Update the user's profile
    $sql = "UPDATE $table SET Username = ?, Email = ?, Address = ?, Contact = ? WHERE Email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssss', $username, $email, $address, $contact_number, $current_email);

    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['contact'] = $contact_number;

        if ($role == "customer") {
            echo "<script>alert('Profile updated successfully!'); window.location.href = '$current_page'; </script>";
        } else if ($role == "staff" || $role == "admin") {
            echo "<script>alert('Profile updated successfully!'); window.location.href = '../AS/ProfileAS.php'; </script>";
        }
    } else {
        echo "<script>
				alert('Error updating profile: " . addslashes($con->error) . "');
				window.location.href = '$current_page';
			</script>";
    }

    $stmt->close();
    $con->close();
}
?>