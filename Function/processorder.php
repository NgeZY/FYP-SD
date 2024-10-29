<?php
ob_start();
session_start();
ob_end_flush();

require 'config.php';

$email = $_SESSION['email'];
$customerName = $_POST['customerName'];
$shippingAddress = $_POST['shippingAddress'];

// Step 1: Calculate the subtotal and prepare order items (as before)
$subtotal = 0;
$orderItems = [];

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

        $orderItems[] = [
            'ProductID' => $row['ProductID'],
            'Quantity' => $row['Quantity'],
            'Price' => $row['Price'],
            'Size' => $row['Size']
        ];
    }
} else {
    echo "<script>alert('Your cart is empty.'); window.history.back();</script>";
    exit;
}

// Step 2: Initialize ToyyibPay payment
$billAmount = $subtotal * 100; // Convert to cents
$categoryCode = '5tbwgxxl';
$apiKey = '0ceq5jjt-sihb-sqvu-p6vb-k8voda9hn3td'; // Replace with your ToyyibPay API key

$data = [
    'userSecretKey' => $apiKey,
    'categoryCode' => $categoryCode,
    'billName' => 'Order Payment',
    'billDescription' => 'Payment for Order from ' . $customerName,
    'billAmount' => $billAmount,
    'billTo' => $customerName,
    'billEmail' => $email,
    'billPhone' => $_POST['contact_number'], // Include a phone number input field
    'billReturnUrl' => 'https://utmadvance.com/CG/order_confirmation.php',
    'billCallbackUrl' => 'https://utmadvance.com/CG/order_confirmation.php',
	'billPriceSetting' => '1',
	'billPayorInfo' => '1'
];

// Send the payment request to ToyyibPay
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);
if (isset($responseData[0]['BillCode'])) {
    // Redirect user to ToyyibPay payment page
    $paymentUrl = 'https://dev.toyyibpay.com/' . $responseData[0]['BillCode'];
    header("Location: $paymentUrl");
    exit;
} else {
    echo "<script>alert('Failed to initiate payment. Please try again.'); window.history.back();</script>";
    exit;
}
