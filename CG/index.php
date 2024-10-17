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
	
	
    <style>
        .product-img img {
            width: 100%;        
            height: 250px;      
            object-fit: cover; 
        }
    </style>


</head>

<body>
	<?php
	session_start();
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
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
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
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="mainpage.php" class="nav-item nav-link">Shop</a>
                            <a href="detail.php" class="nav-item nav-link">Shop Detail</a>
                            <a href="cart.php" class="nav-item nav-link">Cart</a>
							<a href="about.php" class="nav-item nav-link">About Us</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
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
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">ORDER NOW</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">UTM MERCHANDISE</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">ORDER NOW</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">UTM MERCHANDISE</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <?php
			require('../Function/config.php');

			$sql = "SELECT * FROM (
					SELECT *, 
					(SELECT COUNT(ProductID) FROM product AS p2 WHERE p2.Category = p1.Category) AS product_count
					FROM product AS p1
					GROUP BY Category
					) AS temp
					GROUP BY Category";

			$result = mysqli_query($con, $sql); // Execute the query

			if (mysqli_num_rows($result) > 0) {
    			while ($row = mysqli_fetch_assoc($result)) {
					$productImage = !empty($row['Image']) ? $row['Image'] : '../Products/default.png';
					
        			echo '<div class="col-lg-4 col-md-6 pb-1">';
        			echo '    <div class="cat-item d-flex flex-column border mb-4" style="padding: 80px;">';
        			echo '        <p class="text-right">' . $row['product_count'] . ' Products</p>';
        			echo '        <a href="detail.php?id=' . $row['ProductID'] . '" class="cat-img position-relative overflow-hidden mb-3">';
        			echo '            <img class="img-fluid" src="' . $productImage. '" alt="">';
        			echo '        </a>';
        			echo '        <h5 class="font-weight-semi-bold m-0">' . $row['Category'] . '</h5>'; 
        			echo '    </div>';
        			echo '</div>';
    			}
			} else {
    			echo "<p>No products found!</p>";
			}
			?>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="img/offer16.png" alt="" width="850" height="1000">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">UTM Collection</h1>
                        <a href="mainpage.php" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            require('../Function/config.php');
            $sql = "SELECT * FROM product ORDER BY ProductID DESC LIMIT 4"; 

            $result = mysqli_query($con, $sql); // Execute the query

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
					$productImage = !empty($row['Image']) ? $row['Image'] : '../Products/default.png';
					
                    echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">';
                    echo '    <div class="card product-item border-0 mb-4">';
                    echo '        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
                    echo '            <img class="img-fluid w-100" src="' . $productImage. '" alt="Product Image">'; // Product image from database
                    echo '        </div>';
                    echo '        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
                    echo '            <h6 class="text-truncate mb-3">' . $row['ProductName'] . '</h6>'; // Product name from database
                    echo '            <div class="d-flex justify-content-center">';
                    echo '                <h6>RM ' . $row['Price'] . '</h6>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '        <div class="card-footer d-flex justify-content-between bg-light border">';
                    echo '            <a href="detail.php?id=' . $row['ProductID'] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>'; // Link to product details
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No products found!</p>";
            }
            ?>
        </div>
    </div>
    <!-- Products End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">UTM</span>Advance</h1>
                </a>
                <p>UTM Advance showcases a variety of high-quality items that celebrate school spirit and pride, offering everything from apparel to accessories for students and alumni alike.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>UTM Advancement Hub ,Universiti Teknologi Malaysia, Jalan Sultan Yahya Petra, Semarak, 54100 Kuala Lumpur, Federal Territory of Kuala Lumpur</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>utmadvance@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 6789</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
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