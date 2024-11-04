<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

ob_start();
session_start();
ob_end_flush();
require '../Function/config.php'; // Ensure you include your database configuration

if (!isset($_SESSION['email'])) {
    header("Location: Signinform.php"); // Redirect to sign-in if not logged in
    exit;
}

$subtotal = $_SESSION['amount'];
$shippingAddress = $_SESSION['shippingAddress'];
$orderId = $_SESSION['Id']; // Get the order ID from session
$orderItems = [];

// Retrieve order items from the database using the order ID

$sql = "SELECT p.ProductName, oi.Quantity, oi.Price FROM order_items oi INNER JOIN product p ON oi.ProductID = p.ProductID WHERE oi.OrderID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$result = $stmt->get_result();

$orderItems = [];
while ($row = $result->fetch_assoc()) {
    $orderItems[] = $row; // Store each item in the orderItems array
}

$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/style.css">

    <meta charset="utf-8">
    <title>UTM Advance</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 text-center text-lg-right"></div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">UTM</span>Advance</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left"></div>
        </div>
    </div>
    <!-- Topbar End -->
	
	  

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">THANK YOU FOR YOUR ORDER!</h1>
            <div class="d-inline-flex">
                <p>Your order has been placed successfully.</p>
            </div>
            <p>You will receive a confirmation email shortly.</p>
        </div>
    </div>

		<div class="order-confirmation" style="text-align: center; margin: auto;">
        <h2>Order Details:</h2>
		<br>
		<br>
        <table style="width: 100%; max-width: 600px; margin: 20px auto; border-collapse: collapse; font-family: Arial, sans-serif; color: #333;">
            <tr style="background-color: #f09e9a;">
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Order Number</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Total Amount</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Shipping Address</th>
            </tr>
            <tr>
                <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($orderId); ?></td>
                <td style="padding: 12px; border: 1px solid #ddd;">RM<?php echo number_format($subtotal, 2); ?></td>
                <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($shippingAddress); ?></td>
            </tr>
        </table>

		<br>
		<br>
        <h3>Items Ordered:</h3>
		<br>
		<br>
        <table style="width: 100%; max-width: 600px; margin: 20px auto; border-collapse: collapse; font-family: Arial, sans-serif; color: #333;">
            <tr style="background-color: #f09e9a;">
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Product Name</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Quantity</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Price</th>
            </tr>
            <?php foreach ($orderItems as $item) { ?>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($item['ProductName']); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($item['Quantity']); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;">RM<?php echo number_format($item['Price'], 2); ?></td>
                </tr>
            <?php } ?>
        </table>
		<br>
		<br>

        <a href="../index.php">Return to Home</a>
    </div>
</body>
<?php
// Clear session variables related to the order
unset($_SESSION['amount']);
unset($_SESSION['shippingAddress']);
unset($_SESSION['orderItems']);
unset($_SESSION['orderId']);
?>

<!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">UTM</span>Advance</h1>
                </a>
                <p>UTM Advance showcases a variety of high-quality items that celebrate school spirit and pride, offering everything from apparel to accessories for students and alumni alike.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>UTM Advancement Hub ,Universiti Teknologi Malaysia, Jalan Sultan Yahya Petra, Semarak, 54100 Kuala Lumpur, Federal Territory of Kuala Lumpur</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>utmadvance@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 6789</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a href="../index.php" class="nav-item nav-link">Home</a>
                            <a href="mainpage.php" class="nav-item nav-link">Shop</a>
                            <a href="detail.php" class="nav-item nav-link">Shop Detail</a>
							<a href="cart.php" class="nav-item nav-link">Cart</a>
							<a href="about.php" class="nav-item nav-link">About Us</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
							<a href="Viewhistoryorder.php" class="nav-item nav-link">Purchase History</a>
                        </div>
                    </div>
                    
                    
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">UTM ADVANCE</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->
</html>
	

