<?php
session_start();
require 'config.php'; // Include your database connection

if (isset($_GET['id']) && isset($_POST['quantity']) && isset($_POST['size'])) {
    // Get the product ID from the URL
    $product_id = $_GET['id'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $email = $_SESSION['email'];

    // Insert the item with size into the cart
    $sql = "INSERT INTO Cart (Email, ProductID, Size, Quantity, AddedDate) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $con->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("sisi", $email, $product_id, $size, $quantity);

    if ($stmt->execute()) {
        echo "<script>alert('Product added to cart!'); window.location.href = '../CG/cart.php'; </script>"; // Fixed typo in 'location'
    } else {
        echo "<script>alert('Error adding product to cart.'); window.history.back(); </script>";
    }

    $stmt->close();
    $con->close();
} else {
    echo "<script>alert('Invalid request.'); window.history.back(); </script>"; // Handle invalid requests
}
?>