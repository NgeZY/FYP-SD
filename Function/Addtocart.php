<?php
ob_start();
session_start();
ob_end_flush();

require 'config.php'; // Include your database connection

if (isset($_GET['id']) && isset($_POST['quantity'])) {
    // Get the product ID from the URL
    $product_id = $_GET['id'];
    $quantity = $_POST['quantity'];
	$category = $_SESSION['category'];
	unset($_SESSION['category']);
	$size = null;
	if($category == "Shirts" || $category == "Blazers"){
		$size = $_POST['size'];
	}
    $email = $_SESSION['email'];
	
	if($size){
		$sql = "INSERT INTO cart (Email, ProductID, Size, Quantity, AddedDate) VALUES (?, ?, ?, ?, NOW())";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("sisi", $email, $product_id, $size, $quantity);
	} else {
		$sql = "INSERT INTO cart (Email, ProductID, Quantity, AddedDate) VALUES (?, ?, ?, NOW())";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("sii", $email, $product_id, $quantity);
	}

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