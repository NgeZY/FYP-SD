<?php
// Start session to access session variables
session_start();

// Include the database configuration file
require 'config.php';

// Define the upload directory
$uploadDir = '../Uploads/';
$targetFile = $uploadDir . basename($_FILES["profilePhoto"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if a file has been uploaded
if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profilePhoto']['tmp_name'];
    $fileSize = $_FILES['profilePhoto']['size'];
    
    // Check if file is a valid image
    $check = getimagesize($fileTmpPath);
    if ($check !== false) {
        // Check file size (5MB max)
        if ($fileSize <= 5000000) {
            // Allow only certain file formats
            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                // Move the file from the temporary directory to the upload directory
                if (move_uploaded_file($fileTmpPath, $targetFile)) {
                    // Save the image path to the user's session
                    $_SESSION['profilePhoto'] = $targetFile;

                    // Get user email and role from session
                    $userEmail = $_SESSION['email']; // Email of the current user
                    $userRole = $_SESSION['role'];   // Role of the current user (admin, staff, customer)

                    // Determine the table to update based on the user role
                    $table = '';
                    if ($userRole == 'admin') {
                        $table = 'admin';
                    } elseif ($userRole == 'staff') {
                        $table = 'staff';
                    } elseif ($userRole == 'customer') {
                        $table = 'customer';
                    }

                    // Prepare SQL statement to update profile photo
                    if ($table) {
                        $sql = "UPDATE $table SET Profile_photo = ? WHERE Email = ?";
                        $stmt = $con->prepare($sql);

                        // Bind parameters and execute statement
                        $stmt->bind_param('ss', $targetFile, $userEmail);
                        if ($stmt->execute()) {
                            if ($userRole == 'customer') {
                                echo "<script>alert('Profile photo updated successfully!'); window.location.href = '../AS/Profile.php';</script>";
                            } else if ($userRole == 'admin' || $userRole == 'staff') {
                                echo "<script>alert('Profile photo updated successfully!'); window.location.href = '../AS/ProfileAS.php';</script>";
                            }
                        } else {
                            echo "<script>alert('Failed to update profile photo.'); window.history.back();</script>";
                        }

                        // Close statement
                        $stmt->close();
                    } else {
                        echo "<script>alert('Invalid user role.'); window.history.back();</script>";
                    }
                } else {
                    echo "<script>alert('Failed to move uploaded file.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Sorry, only JPG, JPEG, and PNG files are allowed.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Sorry, your file is too large.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('File is not an image.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('No file uploaded or file upload error.'); window.history.back();</script>";
}

// Close database connection
$con->close();
?>
