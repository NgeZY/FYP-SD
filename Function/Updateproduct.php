<?php
// Include the database configuration
require('config.php');
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product details from the form
    $productID = $_SESSION['productID'];
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];
	if($category == "Shirts" || $category == "Blazers"){
		$sizeS = $_POST['stockS'];
		$sizeM = $_POST['stockM'];
		$sizeL = $_POST['stockL'];
		$stock = $sizeS + $sizeM + $sizeL;
	}
    // Update the product in the database
    $sql = "UPDATE product SET ProductName = ?, Price = ?, Category = ?, StockQuantity = ?, Status = ? WHERE ProductID = ?";
	if($category == "Shirts" || $category == "Blazers"){
		$table = ($category == "Shirts") ? "shirt" : "blazer";
		$sql2 = "UPDATE $table SET ProductName = ?, Quantity = ? WHERE ProductID = ?";
	}

    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sdsisi", $productName, $price, $category, $stock, $status, $productID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
			$_SESSION['productName'] = $productName;
			$_SESSION['price'] = $price;
			$_SESSION['category'] = $category;
			$_SESSION['stock'] = $stock;
			$_SESSION['status'] = $status;
            echo "<script>alert('Product details updated successfully'); window.location.href='../AS/Productdetails.php';</script>";
        } else {
            echo "<script>alert('Error updating product details.'); window.location.href='../AS/Productdetails.php';</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href='../AS/Productdetails.php';</script>";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
