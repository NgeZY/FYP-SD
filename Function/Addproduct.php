<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = mysqli_real_escape_string($con, $_POST['productName']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $stockQuantity = mysqli_real_escape_string($con, $_POST['stockQuantity']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
    if (empty($productName)) {
        echo "<script>alert('Product name cannot be empty'); window.history.back();</script>";
        exit();
    }

    // Validate category selection
    if (empty($category)) {
        echo "<script>alert('Product category is not selected'); window.history.back();</script>";
        exit();
    }
    
    if (empty($price)) {
        echo "<script>alert('Product price is not entered'); window.history.back();</script>";
        exit();
    }
    
    if (empty($status)) {
        echo "<script>alert('Product status is not selected'); window.history.back();</script>";
        exit();
    }
    
    if(($stockQuantity == 0 && $status == "In stock") || ($stockQuantity != 0 && $status == "Not In Stock")){
        echo "<script>alert('Stock quantity and status not match.'); window.location.href='../AS/Productdetails.php';</script>";
        exit();
    }
    
    // Insert into the Product table
    $insertProductQuery = "INSERT INTO Product (ProductName, Price, Category, StockQuantity, Status)
                           VALUES ('$productName', '$price', '$category', '$stockQuantity', '$status')";
    
    if (mysqli_query($con, $insertProductQuery)) {
        $productID = mysqli_insert_id($con); // Get the last inserted product ID

        // If category is Blazers or Shirts, insert size details into the respective table
        if ($category === 'Blazers' || $category === 'Shirts') {
            $sizeS = mysqli_real_escape_string($con, $_POST['sizeS']);
            $sizeM = mysqli_real_escape_string($con, $_POST['sizeM']);
            $sizeL = mysqli_real_escape_string($con, $_POST['sizeL']);
            if(empty($sizeS) || empty($sizeM) || empty($sizeL)){
                echo "<script>alert('Stock of size is empty!'); window.location.href='../AS/Productdetails.php';</script>";
                exit();
            }

            if ($category === 'Blazers') {
                $insertBlazerQuery = "INSERT INTO blazer (ProductID, ProductName, SizeS, SizeM, SizeL)
                                      VALUES ('$productID', '$productName', '$sizeS', '$sizeM', '$sizeL')";
                mysqli_query($con, $insertBlazerQuery);
            } elseif ($category === 'Shirts') {
                $insertShirtQuery = "INSERT INTO shirt (ProductID, ProductName, SizeS, SizeM, SizeL)
                                     VALUES ('$productID', '$productName', '$sizeS', '$sizeM', '$sizeL')";
                mysqli_query($con, $insertShirtQuery);
            }
        }

        // Set session variable for success message
        $_SESSION['success'] = 'Product successfully added!';
        header('Location: ../AS/Product.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
