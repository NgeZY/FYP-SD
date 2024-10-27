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
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../path/to/your/styles.css">
	
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
			</div>
           
            <div class="col-lg-6 text-center text-lg-right">
                
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">UTM</span>Advance</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                
            </div>
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

    <div class="order-confirmation">
        
        <h2>Order Details</h2>
       <table style="width: 100%; max-width: 600px; margin: 20px auto; border-collapse: collapse; font-family: Arial, sans-serif; color: #333;">
    <tr style="background-color: #f09e9a;"> <!-- Changed color here -->
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



        <h3>Items Ordered:</h3>

<table style="width: 100%; max-width: 600px; margin: 20px auto; border-collapse: collapse; font-family: Arial, sans-serif; color: #333;">
    <tr style="background-color: #f09e9a;">
        <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Product Name</th>
        <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Quantity</th>
        <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Price</th>
    </tr>
    <?php foreach ($orderItems as $item) { ?>
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($item['ProductName']); ?></td>
            <td style="padding: 12px; border: 1px solid #ddd;"><?php echo $item['Quantity']; ?></td>
            <td style="padding: 12px; border: 1px solid #ddd;">RM<?php echo number_format($item['Price'], 2); ?></td>
        </tr>
    <?php } ?>
</table>

<a href="index.php">Return to Home</a>

</body>
</html>
