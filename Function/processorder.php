<?php
session_start();
require 'config.php'; // Include your database configuration

$email = $_SESSION['email']; // Get the user's email
$customerName = $_POST['customerName']; // Assuming this comes from your form
$shippingAddress = $_POST['shippingAddress']; // Assuming this comes from your form

// Step 1: Calculate the total and prepare to insert the order
$subtotal = 0;
$orderItems = []; // Array to hold cart items

$sql = "SELECT p.ProductID, p.ProductName, p.Price, c.Quantity, c.Size
        FROM cart c
        JOIN product p ON c.ProductID = p.ProductID
        WHERE c.Email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itemTotal = $row['Quantity'] * $row['Price'];
        $subtotal += $itemTotal;

        // Prepare order items for insertion later
        $orderItems[] = [
            'ProductID' => $row['ProductID'],
            'Quantity' => $row['Quantity'],
            'Price' => $row['Price'],
            'Size' => $row['Size']
        ];
    }
} else {
    echo "Your cart is empty.";
    exit; // Stop processing if there are no items
}

// Step 2: Insert the order into the order table
$sqlInsertOrder = "INSERT INTO `order` (CustomerName, Email, Total, ShippingAddress, Status) VALUES (?, ?, ?, ?, ?)";
$stmtOrder = $con->prepare($sqlInsertOrder);
$status = 'Pending'; // Set initial order status
$total = $subtotal; // Set total amount
$stmtOrder->bind_param('ssiss', $customerName, $email, $total, $shippingAddress, $status);
$stmtOrder->execute();
$orderId = $stmtOrder->insert_id; // Get the last inserted OrderID

// Step 3: Insert order items into the order_items table
$sqlInsertItems = "INSERT INTO order_items (OrderID, ProductID, Quantity, Price, Size) VALUES (?, ?, ?, ?, ?)";
$stmtItems = $con->prepare($sqlInsertItems);

foreach ($orderItems as $item) {
    $stmtItems->bind_param('iiids', $orderId, $item['ProductID'], $item['Quantity'], $item['Price'], $item['Size']);
    $stmtItems->execute();
}

// Step 4: Optionally, clear the cart after order placement
$sqlDeleteCart = "DELETE FROM cart WHERE Email = ?";
$stmtDelete = $con->prepare($sqlDeleteCart);
$stmtDelete->bind_param('s', $email);
$stmtDelete->execute();

// Step 5: Redirect or show a success message
echo "<script>alert('Order placed successfully!'); window.location.href = '../CG/cart.php'; </script>";
?>