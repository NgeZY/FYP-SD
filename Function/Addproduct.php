<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];
    
    // Validate data (Optional: Add your own validation here)

    // Prepare an SQL statement to insert the product
    $stmt = $con->prepare("INSERT INTO product (ProductName, Price, Category, StockQuantity, Status) VALUES (?, ?, ?, ?, ?)");
    
    // Bind parameters (s = string, i = integer, d = double, etc.)
    $stmt->bind_param("sssis", $productName, $price, $category, $stock, $status);
    
    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!'); window.location.href = '../AS/Product.php';</script>";
    } else {
        // Handle error
        echo "<script>alert('Error: " . addslashes($stmt->error) . "'); window.history.back();</script>";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$con->close();
?>