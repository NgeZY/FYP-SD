<?php
ob_start();
session_start();
ob_end_flush();

include '../Function/config.php'; // Your database connection

if (isset($_GET['cartid'])) {
    // Validate cartid as an integer
    $cartID = filter_var($_GET['cartid'], FILTER_VALIDATE_INT);
    
    if ($cartID === false) {
        echo "<script>alert('Invalid Cart ID.'); window.history.back(); </script>";
        exit();
    }

    // Prepare the delete statement
    $sql = "DELETE FROM cart WHERE CartID = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('i', $cartID);

        if ($stmt->execute()) {
            // Successfully removed, set a session variable
            $_SESSION['remove_success'] = 'Item removed Successfully.';
            // Redirect back to cart page
            header("Location: ../CG/cart.php"); // Redirect to your cart page
            exit();
        } else {
            // Error executing the query
            echo "<script>alert('Error removing item from cart.'); window.history.back(); </script>";
        }

        $stmt->close();
    } else {
        // Error preparing the statement
        echo "<script>alert('Database error.'); window.history.back(); </script>";
    }
}

$con->close();
?>
