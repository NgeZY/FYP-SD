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
    $status = $_POST['status'];

    // If the category is 'Shirts' or 'Blazers', calculate the total stock and update size quantities
    if ($category == "Shirts" || $category == "Blazers") {
        $sizeS = $_POST['stockS'];
        $sizeM = $_POST['stockM'];
        $sizeL = $_POST['stockL'];
        $stock = $sizeS + $sizeM + $sizeL;

        // Determine the correct table to update (shirt or blazer)
        $table = ($category == "Shirts") ? "shirt" : "blazer";

        // Update the product details in the product table
        $sql = "UPDATE product SET ProductName = ?, Price = ?, Category = ?, StockQuantity = ?, Status = ? WHERE ProductID = ?";

        // Update the specific sizes in the corresponding table
        $sql2 = "UPDATE $table SET ProductName = ?, SizeS = ?, SizeM = ?, SizeL = ? WHERE ProductID = ?";

        // Prepare and execute the first query to update the product table
        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sdsisi", $productName, $price, $category, $stock, $status, $productID);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Now update the sizes in the specific table (shirt or blazer)
                if ($stmt2 = mysqli_prepare($con, $sql2)) {
                    // Bind the size quantities
                    mysqli_stmt_bind_param($stmt2, "siiii", $productName, $sizeS, $sizeM, $sizeL, $productID);

                    // Execute the second statement
                    if (mysqli_stmt_execute($stmt2)) {
                        // Update the session variables
                        $_SESSION['productName'] = $productName;
                        $_SESSION['price'] = $price;
                        $_SESSION['category'] = $category;
                        $_SESSION['stockS'] = $sizeS;
                        $_SESSION['stockM'] = $sizeM;
                        $_SESSION['stockL'] = $sizeL;
                        $_SESSION['status'] = $status;

                        // Success message
                        echo "<script>alert('Product details and sizes updated successfully'); window.location.href='../AS/Productdetails.php';</script>";
                    } else {
                        echo "<script>alert('Error updating size quantities.'); window.location.href='../AS/Productdetails.php';</script>";
                    }

                    // Close the second statement
                    mysqli_stmt_close($stmt2);
                }
            } else {
                echo "<script>alert('Error updating product details.'); window.location.href='../AS/Productdetails.php';</script>";
            }

            // Close the first statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href='../AS/Productdetails.php';</script>";
        }
    } else {
        // If the category is not 'Shirts' or 'Blazers', update the product as usual (without sizes)
        $stock = $_POST['stock'];

        $sql = "UPDATE product SET ProductName = ?, Price = ?, Category = ?, StockQuantity = ?, Status = ? WHERE ProductID = ?";
        
        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sdsisi", $productName, $price, $category, $stock, $status, $productID);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Update session variables
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
    }

    // Close the database connection
    mysqli_close($con);
}
?>
