<?php
// Include the database configuration
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('config.php');
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product details from the form
    $productID = $_SESSION['productID'];
    $productName = $_POST['productName'];
	$precategory = $_SESSION['category'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $status = $_POST['status'];
	
	if($category == ""){
		echo "<script>alert('Product category is not selected'); window.history.back();</script>";
		exit();
	}
	
	$sql_check = "SELECT COUNT(*) FROM product WHERE ProductName = ? AND ProductID != ?";
	if ($stmt_check = mysqli_prepare($con, $sql_check)) {
		// Bind parameters
		mysqli_stmt_bind_param($stmt_check, "si", $productName, $productID);
		// Execute the statement
		mysqli_stmt_execute($stmt_check);
		// Bind result
		mysqli_stmt_bind_result($stmt_check, $count);
		mysqli_stmt_fetch($stmt_check);
		// Close the statement
		mysqli_stmt_close($stmt_check);
		
		if ($count > 0) {
			// If a duplicate product name is found, show an error and stop execution
			echo "<script>alert('Product name already exists. Please choose a different name.'); window.location.href='../AS/Productdetails.php';</script>";
			exit();
		}
	}
	
	if ($precategory != $category) {
        // If the precategory is 'Accessories' and the updated category is 'Blazers' or 'Shirts'
        if ($precategory == 'Accessories' && ($category == 'Shirts' || $category == 'Blazers')) {
            // Insert a new record into the corresponding table
            $table = ($category == "Shirts") ? "shirt" : "blazer";
            $sql = "INSERT INTO $table (ProductID, ProductName, SizeS, SizeM, SizeL) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($con, $sql)) {
                // Bind parameters
                $sizeS = $_POST['stockS'];
				$sizeM = $_POST['stockM'];
				$sizeL = $_POST['stockL'];
				$stock = $sizeS + $sizeM + $sizeL;
                mysqli_stmt_bind_param($stmt, "isiii", $productID, $productName, $sizeS, $sizeM, $sizeL);
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
					$sql2 = "UPDATE product SET ProductName = ?, Price = ?, Category = ?, StockQuantity = ?, Status = ? WHERE ProductID = ?";
                    if ($stmt2 = mysqli_prepare($con, $sql2)) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmt2, "sdsisi", $productName, $price, $category, $stock, $status, $productID);
                        // Execute the statement
                        if (mysqli_stmt_execute($stmt2)) {
                            // Update the session variables
                            $_SESSION['productName'] = $productName;
                            $_SESSION['price'] = $price;
                            $_SESSION['category'] = $category;
							$_SESSION['stock'] = $stock;
							$_SESSION['quantityS'] = $sizeS;
							$_SESSION['quantityM'] = $sizeM;
							$_SESSION['quantityL'] = $sizeL;
                            $_SESSION['status'] = $status;
                            // Success message
                            echo "<script>alert('Product details and sizes inserted successfully'); window.location.href='../AS/Productdetails.php';</script>";
                        } else {
                            echo "<script>alert('Error updating product details.'); window.location.href='../AS/Productdetails.php';</script>";
                        }
                        // Close the statement
                        mysqli_stmt_close($stmt2);
                    } else {
                        echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href='../AS/Productdetails.php';</script>";
                    }
                } else {
                    echo "<script>alert('Error inserting size quantities.'); window.location.href='../AS/Productdetails.php';</script>";
                }
                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href='../AS/Productdetails.php';</script>";
            }
        }
        // If the precategory is 'Blazers' or 'Shirts' and the updated category is 'Accessories'
        elseif (($precategory == 'Shirts' || $precategory == 'Blazers') && $category == 'Accessories') {
            // Delete the record from the corresponding table
            $table = ($precategory == "Shirts") ? "shirt" : "blazer";
            $sql = "DELETE FROM $table WHERE ProductID = ?";
            if ($stmt = mysqli_prepare($con, $sql)) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, "i", $productID);
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    $sql2 = "UPDATE product SET ProductName = ?, Price = ?, Category = ?, StockQuantity = ?, Status = ? WHERE ProductID = ?";
                    if ($stmt2 = mysqli_prepare($con, $sql2)) {
                        // Bind parameters
                        $stock = $_POST['stock'];
                        mysqli_stmt_bind_param($stmt2, "sdsisi", $productName, $price, $category, $stock, $status, $productID);
                        // Execute the statement
                        if (mysqli_stmt_execute($stmt2)) {
                            // Update the session variables
                            $_SESSION['productName'] = $productName;
                            $_SESSION['price'] = $price;
                            $_SESSION['category'] = $category;
                            $_SESSION['quantityS'] = $sizeS;
                            $_SESSION['quantityM'] = $sizeM;
                            $_SESSION['quantityL'] = $sizeL;
                            $_SESSION['status'] = $status;
							$_SESSION['stock'] = $stock;
                            // Success message
                            echo "<script>alert('Product details and sizes inserted successfully'); window.location.href='../AS/Productdetails.php';</script>";
                        } else {
                            echo "<script>alert('Error updating product details.'); window.location.href='../AS/Productdetails.php';</script>";
                        }
                        // Close the statement
                        mysqli_stmt_close($stmt2);
                    } else {
                        echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href='../AS/Productdetails.php';</script>";
                    }
                } else {
                    echo "<script>alert('Error deleting size quantities.'); window.location.href='../AS/Productdetails.php';</script>";
                }
                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Failed to prepare the SQL statement.'); window.location.href='../AS/Productdetails.php';</script>";
            }
        }
    } else {
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
							$_SESSION['quantityS'] = $sizeS;
							$_SESSION['quantityM'] = $sizeM;
							$_SESSION['quantityL'] = $sizeL;
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
	}

    // Close the database connection
    mysqli_close($con);
}
?>
