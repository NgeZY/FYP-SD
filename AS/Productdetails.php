<?php
ob_start();
session_start();
ob_end_flush();
?>

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
	$role = $_SESSION['role'];
    // Check if session variables are set
    if (isset($_SESSION['productID'])) {
        // Extract product details
        $productID = $_SESSION['productID'];
        $productName = $_SESSION['productName'];
        $price = $_SESSION['price'];
        $category = $_SESSION['category'];
		$stock = $_SESSION['stock'];
		$stockS = isset($_SESSION['quantityS']) ? $_SESSION['quantityS'] : 0;
        $stockM = isset($_SESSION['quantityM']) ? $_SESSION['quantityM'] : 0;
        $stockL = isset($_SESSION['quantityL']) ? $_SESSION['quantityL'] : 0;
        $status = $_SESSION['status'];
		
		if(isset($_SESSION['image']))
			$image = $_SESSION['image'];
		else
			$image = "../Products/default.png";
    } else {
        // Handle case where session variable is not set
        echo "<script>
                alert('Product details not found. Please ensure the product is selected correctly.');
                window.history.back();
              </script>";
        exit();
    }
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
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
						<img src="../CG/img/UTM.png" alt="" style="height: 40px; width: auto;">
                        <!--End Logo icon -->
                        <!-- Logo text -->
                    </a>    
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
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
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
                                href="viewOrder.php" aria-expanded="false"><i class="mdi mdi-file"></i><span
                                    class="hide-menu">Order</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="icon-material.php" aria-expanded="false"><i class="mdi mdi-face"></i><span
                                    class="hide-menu">Icon</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="feedbackView.php" aria-expanded="false"><i class="mdi mdi-file"></i><span
                                    class="hide-menu">Feedback</span></a></li>
						<?php
						if($role === "admin"){
                        echo "<li class='sidebar-item'> <a class='sidebar-link waves-effect waves-dark sidebar-link'
                                href='deletestaffview.php' aria-expanded='false'><i class='mdi mdi-face'></i><span
                                    class='hide-menu'>Staff</span></a></li>";
						}
						?>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="deletecustomerview.php" aria-expanded="false"><i class="mdi mdi-face"></i><span
                                    class="hide-menu">Customer</span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="../index.php" aria-expanded="false"><i class="mdi mdi-home"></i><span
                                    class="hide-menu">Homepage</span></a></li>
                        <li class="text-center p-40 upgrade-btn">
                        </li>
                    </ul>
                </nav>
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
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="Product.php">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7"></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                    <div class="product-frame">
                                        <img src="<?= $image ?>" class="product-image" alt="Product Image">
                                    </div>
                                    <form action="../Function/UpdateProductImage.php" method="POST" enctype="multipart/form-data" id="photoForm">
										<label for="productPhoto" class="btn btn-success text-white" id="uploadButton">Upload Product Picture</label>
                                        <input type="file" name="newProductImage" id = "newProductImage" accept="image/*" style="display:none;">
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form id="productForm" method="POST" action="../Function/UpdateProduct.php">
									<input type="hidden" id="formMode" value="view">
                                    <div class="form-group">
                                        <label for="productName">Product Name:</label>
                                        <input type="text" class="form-control" id="productName" name="productName"
                                            value="<?= htmlspecialchars($productName) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="<?= htmlspecialchars($price) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <select class="form-control" id="category" name="category" disabled>
                                            <option value="">Select Category</option>
                                            <option value="Shirts" <?= ($category == 'Shirts') ? 'selected' : '' ?>>Shirts</option>
                                            <option value="Blazers" <?= ($category == 'Blazers') ? 'selected' : '' ?>>Blazers</option>
                                            <option value="Accessories" <?= ($category == 'Accessories') ? 'selected' : '' ?>>Accessories</option>
                                        </select>
                                    </div>
                                    <!-- Stock sizes for Shirts and Blazers -->
                                    <div id="sizeStock" class="form-group" style="display: <?= ($category == 'Shirts' || $category == 'Blazers') ? 'block' : 'none' ?>;">
                                        <label for="stockS">Size S:</label>
                                        <input type="text" class="form-control" id="stockS" name="stockS" value="<?= htmlspecialchars($stockS) ?>" style="margin-bottom: 13px;" oninput="calculateTotal()" readonly>
                                        <label for="stockM">Size M:</label>
                                        <input type="text" class="form-control" id="stockM" name="stockM" value="<?= htmlspecialchars($stockM) ?>" style="margin-bottom: 13px;" oninput="calculateTotal()" readonly>
                                        <label for="stockL">Size L:</label>
                                        <input type="text" class="form-control" id="stockL" name="stockL" value="<?= htmlspecialchars($stockL) ?>" oninput="calculateTotal()" readonly>
                                    </div>
                                    <!-- Stock quantity for Accessories -->
                                    <div id="accessoriesStock" class="form-group">
                                        <label for="stock">Stock Quantity:</label>
                                        <input type="text" class="form-control" id="stock" name="stock" value="<?= htmlspecialchars($stock) ?>" readonly>
                                    </div>
                                    <div class="form-group">
										<label for="status">Status:</label>
    									<select class="form-control" id="status" name="status" disabled>
        									<option value="In Stock" <?= $status === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
        									<option value="Not In Stock" <?= $status === 'Not In Stock' ? 'selected' : '' ?>>Not In Stock</option>
    									</select>
									</div>
                                    <div class="button-container">
                                        <button type="button" id="editButton" class="btn btn-success text-white">Edit</button>
                                        <button type="button" id="backButton" class="btn btn-secondary text-white" style="display: none;">Back</button>
										<form method="POST" action="../Function/Deleteproduct.php" onsubmit="return confirm('Are you sure you want to delete this product?');">
											<input type="hidden" name="ProductID" value="<?php echo $productID; ?>">
											<button type="button" id="deleteButton" class="btn btn-danger text-white button-right-align">Delete</button>
										</form>
                                    </div>
                                </form>
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

document.addEventListener("DOMContentLoaded", function() {
    var editButton = document.getElementById('editButton');
    var backButton = document.getElementById('backButton');
    var productForm = document.getElementById('productForm');
	var stockquantity = document.getElementById('stock');
	var category = document.getElementById('category').value;
	
	var isEditMode = false;

	editButton.addEventListener('click', function() {
		if (!isEditMode) {
			// Enable inputs for editing
			productForm.querySelectorAll('input, select').forEach(function(element) {
				element.removeAttribute('readonly');
				if(category == "Accessories"){
					stock.readOnly = false;
				} else {
					stock.readOnly = true;
				}
				element.removeAttribute('disabled');
			});
			editButton.textContent = 'Update';
			isEditMode = true;
			backButton.style.display = 'inline'; // Show the Back button
		} else {
			// Submit the form to update the product
			productForm.submit();
		}
});

    backButton.addEventListener('click', function() {
        location.reload();
    });
});

document.getElementById('deleteButton').addEventListener('click', function() {
    if (confirm('Are you sure you want to delete this product?')) {
        // Proceed with deletion
        window.location.href = '../Function/DeleteProduct.php?productID=<?= $productID ?>';
    }
});

document.getElementById('category').addEventListener('change', function () {
    var selectedCategory = this.value;
	var stockquantity = document.getElementById('stock');

    // Show/Hide fields based on category
    if (selectedCategory === 'Accessories') {
        document.getElementById('sizeStock').style.display = 'none';
		stockquantity.readOnly = false;
    } else if (selectedCategory === 'Shirts' || selectedCategory === 'Blazers') {
        document.getElementById('sizeStock').style.display = 'block';
		stockquantity.readOnly = true;
    } else {
        // Hide all if no valid category is selected
        document.getElementById('accessoriesStock').style.display = 'none';
        document.getElementById('sizeStock').style.display = 'none';
    }
});

function calculateTotal() {
	var sizeS = parseInt(document.getElementById('stockS').value) || 0;
	var sizeM = parseInt(document.getElementById('stockM').value) || 0;
	var sizeL = parseInt(document.getElementById('stockL').value) || 0;

	var total = sizeS + sizeM + sizeL;
    
   
	document.getElementById('stock').value = total;
}
</script>
</body>

</html>
