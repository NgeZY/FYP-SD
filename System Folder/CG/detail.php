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
	require '../Function/config.php';
	if (isset($_GET['id'])) {
    // Get the product ID from the URL
    	$productID = $_GET['id'];

    // Fetch the product details from the database
    	$sql = "SELECT * FROM product WHERE ProductID = ?";
    	$stmt = $con->prepare($sql);
    	$stmt->bind_param("i", $productID);
    	$stmt->execute();
    	$result = $stmt->get_result();

    // Check if a product is found
    	if ($result->num_rows > 0) {
        	$product = $result->fetch_assoc();
    	} else {
        	echo "<script>alert('Product not found.'); window.history.back(); </script>";
        	exit;
    	}
		
		// Fetch all products excluding the selected one
        $randomSql = "SELECT * FROM product WHERE ProductID != ? LIMIT 5";
        $stmtRandom = $con->prepare($randomSql);
        $stmtRandom->bind_param("i", $productID);
        $stmtRandom->execute();
        $randomResult = $stmtRandom->get_result();

        // Store the random products in an array
        $randomProducts = [];
        while ($row = $randomResult->fetch_assoc()) {
            $randomProducts[] = $row;
        }

        // Handle the case where less than 5 products exist
        if (count($randomProducts) < 5) {
            // Fetch the remaining products excluding the already selected ones
            $placeholders = implode(',', array_fill(0, count($randomProducts), '?'));
            $idsToExclude = array_column($randomProducts, 'ProductID');
            $idsToExclude[] = $productID; // Exclude the current product ID as well

            $inClause = implode(',', array_fill(0, count($idsToExclude), '?'));
            $remainingSql = "SELECT * FROM product WHERE ProductID NOT IN ($inClause) LIMIT ?";
            $stmtRemaining = $con->prepare($remainingSql);

            // Prepare the array of types for the bind_param call
            $types = str_repeat('i', count($idsToExclude)) . 'i'; // All integers, followed by the LIMIT
            $remainingCount = 5 - count($randomProducts);

            // Use array_merge to bind both the excluded IDs and the limit
            $stmtRemaining->bind_param($types, ...array_merge($idsToExclude, [$remainingCount]));
            $stmtRemaining->execute();
            $remainingResult = $stmtRemaining->get_result();

            while ($row = $remainingResult->fetch_assoc()) {
                $randomProducts[] = $row;
            }
        }

        // Shuffle the products to make the order random
        shuffle($randomProducts);
	} else {
    	echo "<script>alert('No product ID provided.'); window.history.back(); </script>";
    	exit;
	}
	
	$productImage = !empty($product['Image']) ? $product['Image'] : '../Products/default.png';
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
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="../index.php" class="nav-item nav-link">Home</a>
                            <a href="mainpage.php" class="nav-item nav-link">Shop</a>
                            <a href="detail.php" class="nav-item nav-link active">Shop Detail</a>
                            <a href="cart.php" class="nav-item nav-link">Cart</a>
							<a href="about.php" class="nav-item nav-link">About Us</a>
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
							<a href="Viewhistoryorder.php" class="nav-item nav-link">Purchase History</a>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <img class="w-100 h-100" src="<?= htmlspecialchars($productImage) ?>" alt="<?= htmlspecialchars($product['ProductName']) ?>">
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?= htmlspecialchars($product['ProductName']) ?></h3>
                <h3 class="font-weight-semi-bold mb-4">RM <?= htmlspecialchars($product['Price']) ?></h3>
                <form action="../Function/Addtocart.php?id=<?= htmlspecialchars($product['ProductID']) ?>" method="POST" onsubmit="return validateForm()">
                    <?php
                    $category = htmlspecialchars($product['Category']);
					$_SESSION['category'] = $category;

                    if ($category == "Shirts" || $category == "Blazers") {
                        echo '<div class="d-flex mb-3">
                                <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-1" name="size" value="S">
                                    <label class="custom-control-label" for="size-1">S</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-2" name="size" value="M">
                                    <label class="custom-control-label" for="size-2">M</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-3" name="size" value="L">
                                    <label class="custom-control-label" for="size-3">L</label>
                                </div>
                              </div>';
                    }
                    ?>
					<input type="hidden" id="categoryInput" value="<?php echo htmlspecialchars($category); ?>">
                    <br><br><br><br><br><br><br><br>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary text-center" name="quantity" value="1" id="quantityInput" readonly>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </form>
            </div>

<script>
    function validateForm() {
		<?php if (!isset($_SESSION['email'])): ?>
            alert('Please sign in to continue.');
            window.location.href = 'Signinform.php';
            return false; // Prevent form submission
        <?php endif; ?>

        var quantityInput = document.getElementById('quantityInput').value;
        var sizeInput = document.querySelector('input[name="size"]:checked');
		var category = document.getElementById('categoryInput').value;
		
		if(category == "Shirts" || category == "Blazers"){
			if (!quantityInput || !sizeInput) {
				alert('Please select a size and enter a quantity.');
				return false; // Prevent form submission
			}
		} else {
			if (!quantityInput) {
				alert('Please enter a quantity.');
				return false; // Prevent form submission
			}
		}
        return true; // Allow form submission
    }
</script>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
					<?php foreach ($randomProducts as $randomProduct) : 
						$randomProductImage = !empty($randomProduct['Image']) ? $randomProduct['Image'] : '../Products/default.png';
					?>
						<div class="card product-item border-0">
							<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
								<img class="img-fluid w-100" src="<?= htmlspecialchars($randomProductImage) ?>" alt="<?= htmlspecialchars($randomProduct['ProductName']) ?>">
							</div>
							<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
								<h6 class="text-truncate mb-3"><?= htmlspecialchars($randomProduct['ProductName']) ?></h6>
								<div class="d-flex justify-content-center">
									<h6>RM <?= number_format($randomProduct['Price'], 2) ?></h6>
								</div>
								<div class="card-footer d-flex justify-content-between bg-light border">
									<a href="detail.php?id=<?= $randomProduct['ProductID'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Details</a>
								</div>
							</div>
						</div>
            		<?php endforeach; ?>
                </div>
            </div>
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