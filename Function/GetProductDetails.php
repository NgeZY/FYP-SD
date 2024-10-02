<?php
// Include your database connection
require('../Function/config.php');
session_start(); // Start the session

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
                $sizeQuery = "SELECT Size, Quantity FROM $table2 WHERE ProductID = ?";
                if ($sizeStmt = mysqli_prepare($con, $sizeQuery)) {
                    mysqli_stmt_bind_param($sizeStmt, "s", $productID);
                    mysqli_stmt_execute($sizeStmt);
                    $sizeResult = mysqli_stmt_get_result($sizeStmt);
                    
                    if (!$sizeResult) {
                        die("Size query failed: " . mysqli_error($con));
                    }

                    // Use switch case to store size quantities in different session variables
                    while ($sizeRow = mysqli_fetch_assoc($sizeResult)) {
                        $size = $sizeRow['Size'];
                        $quantity = htmlspecialchars($sizeRow['Quantity']);

                        switch ($size) {
                            case 'S':
                                $_SESSION['quantityS'] = $quantity;
                                break;
                            case 'M':
                                $_SESSION['quantityM'] = $quantity;
                                break;
                            case 'L':
                                $_SESSION['quantityL'] = $quantity;
                                break;
                            default:
                                // Handle unexpected size
                                $_SESSION['quantityOther'] = $quantity;
                                break;
                        }
                    }

                    mysqli_stmt_close($sizeStmt);
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
