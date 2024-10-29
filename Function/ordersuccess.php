<?php
ob_start();
session_start();
ob_end_flush();
require 'config.php';

// Check if necessary session variables are set
if (!isset($_SESSION['email'], $_SESSION['amount'], $_SESSION['shippingAddress'], $_SESSION['customername'], $_SESSION['orderItems'])) {
    // Redirect to checkout if session data is missing
    header("Location: checkout.php");
    exit;
}

$email = $_SESSION['email'];
$subtotal = $_SESSION['amount'];
$shippingAddress = $_SESSION['shippingAddress'];
$customerName = $_SESSION['customername'];

if (!isset($_GET['bill_code'])) {
    echo "<script>alert('Your payment is unsuccessful'); window.location.href = '../CG/checkout.php';</script>";
    exit;
} else {
// Prepare the SQL statement for inserting the order
$sqlInsertOrder = "INSERT INTO `orders` (CustomerName, Email, Total, ShippingAddress, Status) VALUES (?, ?, ?, ?, ?)";
$stmtOrder = $con->prepare($sqlInsertOrder);

if ($stmtOrder === false) {
    // Handle SQL preparation error
    die('SQL prepare error: ' . htmlspecialchars($con->error));
}

$status = 'Pending'; // Set initial order status
$total = $subtotal; // Set total amount

// Bind and execute the statement
$stmtOrder->bind_param('ssiss', $customerName, $email, $total, $shippingAddress, $status);
$stmtOrder->execute();

if ($stmtOrder->error) {
    // Handle execution error
    die('Execution error: ' . htmlspecialchars($stmtOrder->error));
}

// Get the last inserted OrderID
$orderId = $stmtOrder->insert_id;

// Prepare the SQL statement for inserting order items
$sqlInsertItems = "INSERT INTO order_items (OrderID, ProductID, Quantity, Price, Size) VALUES (?, ?, ?, ?, ?)";
$stmtItems = $con->prepare($sqlInsertItems);

if ($stmtItems === false) {
    // Handle SQL preparation error
    die('SQL prepare error: ' . htmlspecialchars($con->error));
}

// Insert each order item into the order_items table
foreach ($_SESSION['orderItems'] as $item) {
    $stmtItems->bind_param('iiids', $orderId, $item['ProductID'], $item['Quantity'], $item['Price'], $item['Size']);
    $stmtItems->execute();

    if ($stmtItems->error) {
        // Handle execution error
        die('Execution error: ' . htmlspecialchars($stmtItems->error));
    }
}

// Clear the cart after successful order placement
$sqlDeleteCart = "DELETE FROM cart WHERE Email = ?";
$stmtDelete = $con->prepare($sqlDeleteCart);
$stmtDelete->bind_param('s', $email);
$stmtDelete->execute();

if ($stmtDelete->error) {
    // Handle execution error for cart deletion
    die('Execution error during cart deletion: ' . htmlspecialchars($stmtDelete->error));
}

// Clear session variables related to the order
unset($_SESSION['amount']);
unset($_SESSION['shippingAddress']);
unset($_SESSION['customername']);
unset($_SESSION['orderItems']);

// Optional: Redirect to a success page or display a success message
echo "<script>alert('Order placed successfully! Your order ID is: " . htmlspecialchars($orderId) . "'); window.location.href = '../CG/order_confirmation.php';</script>";
}
?>
