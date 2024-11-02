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
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


   <!-- Order History Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <?php
            include '../Function/config.php'; // Your database connection

            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email']; // Assuming email is stored in session after login
            } else {
                echo "<script>alert('Please sign in to continue.'); window.location.href = 'Signinform.php';</script>";
                exit();
            }

            // Query to fetch orders for the current user
            $sql = "SELECT o.OrderID, o.OrderDate, o.Total, o.Status 
                    FROM `order` o
                    WHERE o.Email = ? ORDER BY o.OrderDate DESC";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any orders exist
            if ($result->num_rows > 0) {
                echo '<table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">';

                // Loop through each order
                while ($order = $result->fetch_assoc()) {
                    echo '<tr>
                            <td class="align-middle">' . htmlspecialchars($order['OrderID']) . '</td>
                            <td class="align-middle">' . htmlspecialchars($order['OrderDate']) . '</td>
                            <td class="align-middle">RM ' . number_format($order['Total'], 2) . '</td>
                            <td class="align-middle">' . htmlspecialchars($order['Status']) . '</td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-primary" onclick="toggleOrderDetails(' . $order['OrderID'] . ')">View Items</button>
                            </td>
                          </tr>';

                    // Query to fetch order items for each order
                    $item_sql = "SELECT oi.ProductID, p.ProductName, oi.Quantity, oi.Price, oi.Size 
                                 FROM order_items oi
                                 JOIN product p ON oi.ProductID = p.ProductID
                                 WHERE oi.OrderID = ?";
                    $item_stmt = $con->prepare($item_sql);
                    $item_stmt->bind_param('i', $order['OrderID']);
                    $item_stmt->execute();
                    $item_result = $item_stmt->get_result();

                    // Display order items
                    echo '<tr id="order-' . $order['OrderID'] . '" style="display: none;">
                            <td colspan="5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Size</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">';

                    while ($item = $item_result->fetch_assoc()) {
                        $subtotal = $item['Price'] * $item['Quantity'];
                        echo '<tr>
                                <td class="align-middle">' . htmlspecialchars($item['ProductName']) . '</td>
                                <td class="align-middle">RM ' . number_format($item['Price'], 2) . '</td>
                                <td class="align-middle">' . $item['Quantity'] . '</td>
                                <td class="align-middle">' . htmlspecialchars($item['Size']) . '</td>
                                <td class="align-middle">RM ' . number_format($subtotal, 2) . '</td>
                              </tr>';
                    }

                    echo '</tbody></table></td></tr>';
                    $item_stmt->close();
                }

                echo '</tbody></table>';
            } else {
                echo '<p>You have no order history.</p>';
            }

            $stmt->close();
            $con->close();
            ?>
        </div>
    </div>
</div>
<!-- Order History End -->

<script>
function toggleOrderDetails(orderID) {
    const orderDetails = document.getElementById('order-' + orderID);
    if (orderDetails.style.display === 'none') {
        orderDetails.style.display = 'table-row';
    } else {
        orderDetails.style.display = 'none';
    }
}
</script>

 

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
</body>

</html>