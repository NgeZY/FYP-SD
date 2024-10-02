<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = mysqli_real_escape_string($con, $_POST['productName']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $stockQuantity = mysqli_real_escape_string($con, $_POST['stockQuantity']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    
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

        // Redirect or show success message
        header('Location: ../AS/Product.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
