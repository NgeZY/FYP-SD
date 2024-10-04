<?php
// Start session to access session variables
session_start();

// Include the database configuration file
require 'config.php';

// Define the upload directory
$uploadDir = '../Products/';
$targetFile = $uploadDir . basename($_FILES["newProductImage"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if a file has been uploaded
if (isset($_FILES['newProductImage']) && $_FILES['newProductImage']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['newProductImage']['tmp_name'];
    $fileSize = $_FILES['newProductImage']['size'];

    // Check if file is a valid image
    $check = getimagesize($fileTmpPath);
    if ($check !== false) {
        // Check file size (5MB max)
        if ($fileSize <= 5000000) {
            // Allow only certain file formats
            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                // Move the file from the temporary directory to the upload directory
                if (move_uploaded_file($fileTmpPath, $targetFile)) {
                    // Get productID from session
                    if (isset($_SESSION['productID'])) {
                        $productID = $_SESSION['productID'];

                        // Save the image path to the database
                        $sql = "UPDATE product SET Image = ? WHERE ProductID = ?";
                        $stmt = $con->prepare($sql);

                        // Bind parameters and execute statement
                        $stmt->bind_param('si', $targetFile, $productID);
                        if ($stmt->execute()) {
							$_SESSION['image'] = $targetFile;
                            echo "<script>alert('Product image updated successfully!'); window.location.href = '../AS/Productdetails.php';</script>";
                        } else {
                            echo "<script>alert('Failed to update product image.'); window.history.back();</script>";
                        }

                        // Close statement
                        $stmt->close();
                    } else {
                        echo "<script>alert('Product ID not found in session.'); window.history.back();</script>";
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
