<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: Signinform.php"); // Redirect to sign-in if not logged in
    exit;
}

// Display a success message and order details
?>
<!DOCTYPE html>
<html lang="en">
<?php 
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

ob_start();

if (session_status() === PHP_SESSION_NONE){
	session_set_cookies_params([
		'domain' => 'utmadvance.com',
		'secure' => true,
		'httponly' => true,
		'samesite' => 'Strict',
]);
	session_start();
}
ob_end_flush();
var_dump(["session status" => session_status(), "write permission" => is_writable(session_save_path()), "save path" => session_save_path()])

?>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../path/to/your/styles.css">
</head>
<body>
    <div class="order-confirmation">
        <h1>Thank you for your order!</h1>
        <p>Your order has been placed successfully.</p>
        
        <h2>Order Details</h2>
        <ul>
            <li><strong>Order Number:</strong> <?php echo htmlspecialchars($orderId); ?></li>
            <li><strong>Total Amount:</strong> RM<?php echo number_format($subtotal, 2); ?></li>
            <li><strong>Shipping Address:</strong> <?php echo htmlspecialchars($shippingAddress); ?></li>
        </ul>

        <h3>Items Ordered:</h3>
        <ul>
            <?php foreach ($orderItems as $item) { ?>
                <li><?php echo htmlspecialchars($item['ProductName']); ?> - Quantity: <?php echo $item['Quantity']; ?> - Price: RM<?php echo number_format($item['Price'], 2); ?></li>
            <?php } ?>
        </ul>

        <p>You will receive a confirmation email shortly.</p>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>
