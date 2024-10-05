<?php
session_start();

// Include the database configuration file
require 'config.php'; // Assuming you have a database connection file

// Check if the user is logged in and has the proper role (if applicable)
if (!isset($_SESSION['role'])) {
    // Redirect to login if the user is not logged in
    header("Location: ../CG/Signinform.php");
    exit();
}

// Check if ProductID is set
if (isset($_SESSION['productID'])) {
    $productID = $_SESSION['productID'];
	$category = $_SESSION['category'];
	
	if($category == "Shirts" || $category == "Blazers"){
    $table = ($category == "Shirts") ? "shirt" : "blazer";
    $sql = "DELETE FROM $table WHERE ProductID = ?";
    $stmt2 = $con->prepare($sql);
    $stmt2->bind_param("i", $productID);
    $stmt2->execute(); // Execute the query to delete associated records
    $stmt2->close();
}

    // Prepare the SQL delete query
    $query = "DELETE FROM product WHERE ProductID = ?";

    if ($stmt = $con->prepare($query)) {
        // Bind the parameter
        $stmt->bind_param("i", $productID);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to product list with success message
            echo "<script>alert('Product deleted successfully'); window.location.href= '../AS/Product.php';</script>";
        } else {
            // Show an error message if the deletion fails
            echo "<script>alert('Error deleting product'); window.location.href= '../AS/Product.php';</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Database error'); window.location.href='../AS/Product.php';</script>";
    }
} else {
    // Redirect if ProductID is not set
	echo "<script>alert('Product ID not set'); window.location.href='../AS/Product.php';</script>";
    exit();
}

// Close the database connection
$con->close();
?>
