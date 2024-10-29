<?php
ob_start();
session_start();
ob_end_flush();

require 'config.php';

$email = $_SESSION['email'];
$customerName = $_POST['customerName'];
$shippingAddress = $_POST['shippingAddress'];
$contact = $_POST['contact_number'];

// Step 1: Calculate the subtotal and prepare order items
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
    'billPhone' => $contact, // Include a phone number input field
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

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL error: ' . curl_error($ch) . '";
    exit;
}
curl_close($ch);

// Print the raw response for debugging
echo "<pre>";
print_r($response); // This will show you the raw response from the API
echo "</pre>";

// Decode the JSON response
$responseData = json_decode($response, true);
if ($responseData === null) {
    echo "Failed to decode JSON response.";
    exit;
}

// Check if the response contains the expected BillCode
if (isset($responseData[0]['BillCode'])) {
    // Redirect user to ToyyibPay payment page
    $paymentUrl = 'https://dev.toyyibpay.com/' . $responseData[0]['BillCode'];
    header("Location: $paymentUrl");
    exit;
} else {
    // If BillCode is not found, print the response data for debugging
    echo "<pre>";
    print_r($responseData);
    echo "</pre>";
    echo "Failed to initiate payment. Please try again.";
    exit;
}