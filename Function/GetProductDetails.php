<?php
ob_start();
session_start();
ob_end_flush();

// Include your database connection
require('../Function/config.php');

// Check if the ID is passed and set
if (isset($_GET['id'])) {
    $productID = htmlspecialchars($_GET['id']);
    
    // Prepare and execute query to fetch the product details
    $query = "SELECT ProductName, Price, Category, StockQuantity, Status, Image FROM product WHERE ProductID = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $productID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Database query failed: " . mysqli_error($con));
        }

        if (mysqli_num_rows($result) == 1) {
            $productDetails = mysqli_fetch_assoc($result);
            $productImagePath = $productDetails['Image'];

            // Store each detail in session variables
            $_SESSION['productID'] = $productID;
            $_SESSION['productName'] = htmlspecialchars($productDetails['ProductName']);
            $_SESSION['price'] = htmlspecialchars($productDetails['Price']);
            $_SESSION['category'] = htmlspecialchars($productDetails['Category']);
            $category = $_SESSION['category'];
            $_SESSION['stock'] = htmlspecialchars($productDetails['StockQuantity']);

            $_SESSION['status'] = htmlspecialchars($productDetails['Status']);
            if (!empty($productImagePath)) {
                $_SESSION['image'] = $productImagePath;
            } else {
                unset($_SESSION['image']); // Clear session variable if no photo
            }

            // Additional logic for Blazers and Shirts categories
            if ($category == "Blazers" || $category == "Shirts") {
				$table2 = ($category == "Blazers") ? "blazer" : "shirt";
                // Query to get size and quantity based on category
                $query2 = "SELECT SizeS, SizeM, SizeL FROM $table2 WHERE ProductID = ?";
                if ($stmt2 = mysqli_prepare($con, $query2)) {
                    mysqli_stmt_bind_param($stmt2, "s", $productID);
                    mysqli_stmt_execute($stmt2);
                    $result2 = mysqli_stmt_get_result($stmt2);
                    
                    if (!$result2) {
                        die("Size query failed: " . mysqli_error($con));
                    }
					$size = mysqli_fetch_assoc($result2);
					$_SESSION['quantityS'] = htmlspecialchars($size['SizeS']);
					$_SESSION['quantityM'] = htmlspecialchars($size['SizeM']);
					$_SESSION['quantityL'] = htmlspecialchars($size['SizeL']);

                    mysqli_stmt_close($stmt2);
                } else {
                    die("Failed to prepare size SQL statement: " . mysqli_error($con));
                }
            }

            // Redirect to productdetails.php
            header("Location: ../AS/Productdetails.php");
            exit();
        } else {
            // Handle case where product ID is not found
            echo "<script>
                    alert('Product not found.');
                    window.location.href = '../AS/Product.php';
                  </script>";
            exit();
        }
    } else {
        die("Failed to prepare SQL statement: " . mysqli_error($con));
    }
} else {
    // Handle case where ID is not provided
    echo "<script>
            alert('No product ID provided.');
            window.location.href = '../AS/Product.php';
          </script>";
    exit();
}
?>
