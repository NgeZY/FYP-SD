<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="...">
    <meta name="description" content="...">
    <meta name="robots" content="noindex,nofollow">
    <title>UTM Advance</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style>
        .product-frame {
            width: 150px;
            height: 150px;
            border: 3px solid #ccc;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .text-danger {
            color: #dc3545;
            font-size: 16px;
            margin-top: 5px;
        }
        .form-group .text-danger#contactError {
            margin-top: 10px;
        }
        .button-container {
            display: flex;
			justify-content: space-between;
            gap: 1rem;
            margin-top: 1rem;
        }
		
		.button-right-align {
			margin-left: auto; /* This pushes the button to the right */
		}
		
		#uploadButton {
            margin-top: 30px; /* Adjust the value as needed */
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Start the session
    ?>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- Logo -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                       
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        
                    <!-- End Logo -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav float-start me-auto">
                        <!-- Search -->

                    </ul>
                    <!-- Right side toggle and nav items -->
                    <ul class="navbar-nav float-end" style="font-size: 16px;">
                        <!-- User profile and search -->
                        <a href="../Function/Signout.php" class="nav-item nav-link">Sign Out</a>
                        <!-- User profile and search -->
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            
                            <!-- End User Profile-->
                        </li>
                        
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="ProfileAS.php" aria-expanded="false"><i
                                    class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="Product.php" aria-expanded="false"><i class="mdi mdi-border-all"></i><span
                                    class="hide-menu">Product</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="icon-material.php" aria-expanded="false"><i class="mdi mdi-face"></i><span
                                    class="hide-menu">Icon</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="feedbackView.php" aria-expanded="false"><i class="mdi mdi-file"></i><span
                                    class="hide-menu">Feedback</span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="deletestaffview.php" aria-expanded="false"><i class="mdi mdi-home"></i><span
                                    class="hide-menu">Staff</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="../CG/index.php" aria-expanded="false"><i class="mdi mdi-home"></i><span
                                    class="hide-menu">Homepage</span></a></li>
                        
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Product Details</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="Product.php">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7"></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                               <form id="productForm" method="POST" action="../Function/Addproduct.php">
									<div class="form-group">
										<label for="productName">Product Name:</label>
										<input type="text" class="form-control" id="productName" name="productName" required>
									</div>

									<div class="form-group">
										<label for="price">Price:</label>
										<input type="text" class="form-control" id="price" name="price" required>
									</div>

									<div class="form-group">
										<label for="category">Category:</label>
										<select class="form-control" id="category" name="category" required onchange="toggleSizeQuantityFields()">
										<option value="">Select Category</option>
										<option value="Shirts">Shirts</option>
										<option value="Blazers">Blazers</option>
										<option value="Accessories">Accessories</option>
										</select>
									</div>

									<div class="form-group sizequantity" style="display: none;" id="sizeQuantityDiv">
									<label for="sizeS">Size S - Quantity:</label>
									<input type="number" class="form-control mb-3" id="sizeS" name="sizeS" placeholder="Enter quantity for Size S" oninput="calculateTotal()" style="margin-bottom: 13px;">

									<label for="sizeM">Size M - Quantity:</label>
									<input type="number" class="form-control mb-3" id="sizeM" name="sizeM" placeholder="Enter quantity for Size M" oninput="calculateTotal()" style="margin-bottom: 13px;">

									<label for="sizeL">Size L - Quantity:</label>
									<input type="number" class="form-control mb-3" id="sizeL" name="sizeL" placeholder="Enter quantity for Size L" oninput="calculateTotal()" style="margin-bottom: 13px;">
									</div>

									<div class="form-group">
									<label for="stockQuantity">Stock Quantity:</label>
									<input type="number" class="form-control" id="stockQuantity" name="stockQuantity" placeholder="Enter stock quantity">
									</div>

									<div class="form-group">
									<label for="status">Status:</label>
									<select class="form-control" id="status" name="status" required>
										<option value="In Stock">In Stock</option>
										<option value="Not In Stock">Not In Stock</option>
									</select>
									</div>

									<div class="form-group">
									<button type="submit" class="btn btn-success text-white">Submit</button>
									</div>
									</form>

								<script>
								function toggleSizeQuantityFields() {
									var category = document.getElementById('category').value;
									var sizeQuantityDiv = document.getElementById('sizeQuantityDiv');
									var stockquantity = document.getElementById('stockQuantity');

									if (category === 'Shirts' || category === 'Blazers') {
										sizeQuantityDiv.style.display = 'block';
										stockQuantity.readOnly = true;
									} else {
									sizeQuantityDiv.style.display = 'none'; 
									document.getElementById('sizeS').value = ''; 
									document.getElementById('sizeM').value = '';
									document.getElementById('sizeL').value = '';
									stockquantity.readOnly = false;
									document.getElementById('stockQuantity').value = ''; 
										}
									}

								function calculateTotal() {
									var sizeS = parseInt(document.getElementById('sizeS').value) || 0;
									var sizeM = parseInt(document.getElementById('sizeM').value) || 0;
									var sizeL = parseInt(document.getElementById('sizeL').value) || 0;

									var total = sizeS + sizeM + sizeL;
    
   
									document.getElementById('stockQuantity').value = total;
									}
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer text-center">
			&copy; 2024 UTM Advance
			</footer>
		</div>
	</div>
<!-- All Jquery -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/app-style-switcher.js"></script>
<script src="dist/js/waves.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<script src="dist/js/custom.js"></script>
<script src="assets/libs/chartist/dist/chartist.min.js"></script>
<script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="dist/js/pages/dashboards/dashboard1.js"></script>
<!-- Custom JS -->
<script>
document.getElementById('uploadButton').addEventListener('click', function(event) {
    event.preventDefault();  // Prevent the default button action
    document.getElementById('newProductImage').click();  // Open the file dialog
});

// Submit the form when the user selects a file
document.getElementById('newProductImage').addEventListener('change', function() {
    document.getElementById('photoForm').submit();  // Submit the form on file selection
});
</script>
</body>

</html>
