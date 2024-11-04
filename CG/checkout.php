<?php
ob_start();
session_start();
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
	<?php
	$defaultAddress = isset($_SESSION['address']) ? $_SESSION['address'] : '';
	?>
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


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden">
                        <a href="mainpage.php?category=Shirts" class="nav-item nav-link">Shirts</a>
                        <a href="mainpage.php?category=Blazers" class="nav-item nav-link">Blazers</a>
                        <a href="mainpage.php?category=Accessories" class="nav-item nav-link">Accessories</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">UTM</span>Advance</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="../index.php" class="nav-item nav-link">Home</a>
                            <a href="mainpage.php" class="nav-item nav-link">Shop</a>
                            <a href="detail.php" class="nav-item nav-link">Shop Detail</a>
                            <a href="cart.php" class="nav-item nav-link">Cart</a>
							<a href="about.php" class="nav-item nav-link">About Us</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
							<a href="Viewhistoryorder.php" class="nav-item nav-link">History</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php if(isset($_SESSION['username'])): ?>
                                <a href="<?php 
											if ($_SESSION['role'] === 'customer') {
												echo '../AS/Profile.php';
											} elseif ($_SESSION['role'] === 'staff' || $_SESSION['role'] === 'admin') {
												echo '../AS/index.php';
											}?>" class="nav-item nav-link"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                                <a href="../Function/Signout.php" class="nav-item nav-link">Sign Out</a>
                            <?php else: ?>
                                <a href="../CG/Signinform.php" class="nav-item nav-link">Sign In</a>
                                <a href="../CG/Signupform.html" class="nav-item nav-link">Sign Up</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" id="firstName" placeholder="Mohd" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" id="lastName" placeholder="Afiq" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" id="address" placeholder="123, Jalan ABC, Taman DEF, Kuala Lumpur" required>
                        </div>
						<div class="col-md-6 form-group">
                            <label>Contact Number</label>
                            <input class="form-control" type="number" id="contact" placeholder="0123456789" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto">Use default address</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
						<?php
						require '../Function/config.php';
						
						$email = $_SESSION['email'];
						$subtotal = 0;
						
						$sql = "SELECT p.ProductName, p.Price, c.Quantity , c.Size
								FROM cart c
								JOIN product p ON c.ProductID = p.ProductID
								WHERE c.Email = ?";
						$stmt = $con->prepare($sql);
						$stmt->bind_param('s', $email);
						$stmt->execute();
						$result = $stmt->get_result();
						
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								$itemTotal = $row['Quantity'] * $row['Price'];
								$subtotal += $itemTotal;
								echo '<div class="d-flex justify-content-between">
									<p>' . htmlspecialchars($row['ProductName']) . '(' . htmlspecialchars($row['Size']) . ') - ' . $row['Quantity'] . '</p>
									<p>RM ' . number_format($itemTotal, 2) . '</p>
									</div>';
							}
						} else {
							echo '<div class = "d-flex justify-content-between">
									<p>Your cart is empty.</p>
								  </div>';
						}
						
						echo '<hr class="mt-0">
							  <div class = "d-flex justify-content-between mb-3 pt-1">
									<h6 class="font-weight-medium">Subtotal</h6>
									<h6 class="font-weight-medium">RM '. number_format($subtotal, 2) .'</h6>
							  </div>';
							  
						$total = $subtotal;
						?>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">RM <?php echo number_format($total, 2); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
					<form action="../Function/processorder.php" method="POST" onsubmit = "return populatePaymentDetails()">
                    <div class="card-body">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="payment" id="onlinebanking" value="onlinebanking" required>
								<label class="custom-control-label" for="onlinebanking">Online Banking</label>
							</div>
						</div>
						<input type="hidden" id="customerName" name="customerName">
						<input type="hidden" id="shippingAddress" name="shippingAddress">
						<input type="hidden" id="contact_number" name="contact_number">
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type = "submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


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
                            <a class="text-dark mb-2" href="../index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="mainpage.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-dark mb-2" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
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


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
	
	<!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
	
	<script>
    function populatePaymentDetails() {
    var firstName = document.getElementById('firstName').value.trim();
    var lastName = document.getElementById('lastName').value.trim();
    var address = document.getElementById('address').value.trim();
    var contact_number = document.getElementById('contact').value.trim();

    // Check if the name and address fields are empty
    if (firstName === "") {
        alert("First name cannot be empty.");
        return false;
    }
    if (lastName === "") {
        alert("Last name cannot be empty.");
        return false;
    }
    if (address === "") {
        alert("Shipping address cannot be empty.");
        return false;
    }

    // Check if contact number is between 10 and 11 digits
    if (!/^\d{10,11}$/.test(contact_number)) {
        alert("Please enter a valid contact number with 10-11 digits.");
        return false;
    }

    // Populate the hidden fields with the validated data
    document.getElementById('customerName').value = firstName + ' ' + lastName;
    document.getElementById('shippingAddress').value = address;
    document.getElementById('contact_number').value = contact_number;

    return true; // Allow form submission if all validations pass
}

	</script>
	
	<script>
	$(document).ready(function() {
		// Get session variables from PHP
		var defaultAddress = "<?php echo $defaultAddress; ?>"; 

		// When the checkbox is checked, use the default address
		$("#shipto").change(function() {
			if ($(this).is(":checked")) {
				$("#address").val(defaultAddress);      // Fill the address field
			} else {
				$("#address").val('');    // Clear the input if unchecked
			}
		});

		// Optionally, handle the initial state when the page loads
		if ($("#shipto").is(":checked")) {
			$("#address").val(defaultAddress);
		}
	});
	</script>
</body>

</html>