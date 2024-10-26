<?php
session_start();
require 'config.php';

$email = $_SESSION['email'];

// Step 1: Verify the payment status
$billCode = $_GET['billcode'];
$apiKey = '0ceq5jjt-sihb-sqvu-p6vb-k8voda9hn3td';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://dev.toyyibpay.com/index.php/api/getBillTransactions?userSecretKey=$apiKey&billCode=$billCode");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$transactionData = json_decode($response, true);
if ($transactionData[0]['billpaymentStatus'] == "1") { // Status "1" means payment successful

    // Step 2: Insert order into the database
    $customerName = $_SESSION['customerName'];
    $shippingAddress = $_SESSION['shippingAddress'];
    $subtotal = $_SESSION['subtotal'];
    $orderItems = $_SESSION['orderItems'];

    // Insert the order
    $sqlInsertOrder = "INSERT INTO `order` (CustomerName, Email, Total, ShippingAddress, Status) VALUES (?, ?, ?, ?, ?)";
    $stmtOrder = $con->prepare($sqlInsertOrder);
    $status = 'Pending';
    $total = $subtotal;
    $stmtOrder->bind_param('ssiss', $customerName, $email, $total, $shippingAddress, $status);
    $stmtOrder->execute();
    $orderId = $stmtOrder->insert_id;

    // Insert each order item
    $sqlInsertItems = "INSERT INTO order_items (OrderID, ProductID, Quantity, Price, Size) VALUES (?, ?, ?, ?, ?)";
    $stmtItems = $con->prepare($sqlInsertItems);

    foreach ($orderItems as $item) {
        $stmtItems->bind_param('iiids', $orderId, $item['ProductID'], $item['Quantity'], $item['Price'], $item['Size']);
        $stmtItems->execute();
    }

    // Clear the user's cart after successful payment
    $sqlDeleteCart = "DELETE FROM cart WHERE Email = ?";
    $stmtDelete = $con->prepare($sqlDeleteCart);
    $stmtDelete->bind_param('s', $email);
    $stmtDelete->execute();

    echo "<script>alert('Order placed successfully!'); window.location.href = '../CG/cart.php'; </script>";

} else {
    echo "<script>alert('Payment failed. Please try again.'); window.location.href = '../CG/cart.php'; </script>";
    exit;
}
?>
