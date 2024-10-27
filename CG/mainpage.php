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
        height: 350px;      
        object-fit: cover; 
    }
		
	.product-item {
		min-width: 450px;
	}
	
	.img-container {
		width: 100%;
		height: 350px;  /* Ensuring image containers are the same size */
		overflow: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.img-container img {
		width: 100%;
		height: 100%;
		object-fit: cover;  /* Ensure images fit the container without stretching */
	}
    </style>
	
</head>


<body>
	<?php
	session_start();
	?>
	
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">UTM</span>Advance</h1>
                </a>
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
                            <a href="mainpage.php" class="nav-item nav-link active">Shop</a>
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
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">UTM MERCHANDISE</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
				<?php
				require('../Function/config.php');

				$query_all = "SELECT COUNT(*) as total_products FROM product"; // All products
				$query_1 = "SELECT COUNT(*) as total_products FROM product WHERE Price BETWEEN 1 AND 30"; // RM1 - RM30
				$query_2 = "SELECT COUNT(*) as total_products FROM product WHERE Price BETWEEN 31 AND 60"; // RM31 - RM60
				$query_3 = "SELECT COUNT(*) as total_products FROM product WHERE Price BETWEEN 61 AND 90"; // RM61 - RM90
				$query_4 = "SELECT COUNT(*) as total_products FROM product WHERE Price BETWEEN 91 AND 120"; // RM91 - RM120
				$query_5 = "SELECT COUNT(*) as total_products FROM product WHERE Price > 120"; // RM121 and above

				$result_all = mysqli_fetch_assoc(mysqli_query($con, $query_all))['total_products'];
				$result_1 = mysqli_fetch_assoc(mysqli_query($con, $query_1))['total_products'];
				$result_2 = mysqli_fetch_assoc(mysqli_query($con, $query_2))['total_products'];
				$result_3 = mysqli_fetch_assoc(mysqli_query($con, $query_3))['total_products'];
				$result_4 = mysqli_fetch_assoc(mysqli_query($con, $query_4))['total_products'];
				$result_5 = mysqli_fetch_assoc(mysqli_query($con, $query_5))['total_products'];

				?>
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal"><?php echo $result_all ? $result_all : 0; ?></span> <!-- Display all stock -->
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">RM1 - RM30</label>
                            <span class="badge border font-weight-normal"><?php echo $result_1 ? $result_1 : 0; ?></span> <!-- Stock for RM1 - RM30 -->
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">RM31 - RM60</label>
                            <span class="badge border font-weight-normal"><?php echo $result_2 ? $result_2 : 0; ?></span> <!-- Stock for RM31 - RM60 -->
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">RM61 - RM90</label>
                            <span class="badge border font-weight-normal"><?php echo $result_3 ? $result_3 : 0; ?></span> <!-- Stock for RM61 - RM90 -->
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">RM91 - RM120</label>
                            <span class="badge border font-weight-normal"><?php echo $result_4 ? $result_4 : 0; ?></span> <!-- Stock for RM91 - RM120 -->
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">RM121 and above</label>
                            <span class="badge border font-weight-normal"><?php echo $result_5 ? $result_5 : 0; ?></span> <!-- Stock for RM121 and above -->
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
			<?php
			require '../Function/config.php';

			// Get current page number from query parameter, default to 1
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
			$limit = 9; // Number of products per page
			$offset = ($page - 1) * $limit;

			// Get total number of products
			$totalProductsQuery = "SELECT COUNT(*) AS total FROM product";
			$result = mysqli_query($con, $totalProductsQuery);
			$totalProducts = mysqli_fetch_assoc($result)['total'];

			// Calculate total pages
			$totalPages = ceil($totalProducts / $limit);

			// Fetch products for the current page
			if(isset($_GET['category'])){
				$category = $_GET['category'];
				$productsQuery = "SELECT * FROM product WHERE Category = '$category' LIMIT $limit OFFSET $offset";
			} else {
				$productsQuery = "SELECT * FROM product LIMIT $limit OFFSET $offset";
			}
			$productsResult = mysqli_query($con, $productsQuery);
			?>
			<div class="col-lg-9 col-md-12">
    			<div class="row pb-3">
					<div id = "product-list" class="row pb-3">
        			<?php while ($product = mysqli_fetch_assoc($productsResult)): ?>
            			<?php $productImage = !empty($product['Image']) ? $product['Image'] : '../Products/default.png'; ?>
            			<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                			<div class="card product-item border-0 mb-4">
                    			<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        			<img class="img-fluid w-100" src="<?= $productImage ?>" alt="">
                    			</div>
                    			<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        			<h6 class="text-truncate mb-3"><?= htmlspecialchars($product['ProductName']) ?></h6>
                        			<div class="d-flex justify-content-center">
                            			<h6>RM <?= number_format($product['Price'], 2) ?></h6>
                        			</div>
                    			</div>
                    			<div class="card-footer d-flex justify-content-between bg-light border">
                        			<a href="detail.php?id=<?= $product['ProductID'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    			</div>
                			</div>
            			</div>
        			<?php endwhile; ?>
					</div>
        
        			<div class="col-12 pb-1">
            			<nav aria-label="Page navigation">
                			<ul class="pagination justify-content-center mb-3">
                    			<?php if ($page > 1): ?>
                        			<li class="page-item">
                            			<a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                			<span aria-hidden="true">&laquo;</span>
                                			<span class="sr-only">Previous</span>
                            			</a>
                        			</li>
                    			<?php else: ?>
                        			<li class="page-item disabled">
                            			<a class="page-link" href="#" aria-label="Previous">
                                			<span aria-hidden="true">&laquo;</span>
                                			<span class="sr-only">Previous</span>
                            			</a>
                        			</li>
                    			<?php endif; ?>

                    			<?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        			<li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            			<a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        			</li>
                    			<?php endfor; ?>

                    			<?php if ($page < $totalPages): ?>
                        			<li class="page-item">
                            			<a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                			<span aria-hidden="true">&raquo;</span>
                                			<span aria-hidden="true">Next</span>
                            			</a>
                        			</li>
                    			<?php else: ?>
                        			<li class="page-item disabled">
                            			<a class="page-link" href="#" aria-label="Next">
                                			<span aria-hidden="true">&raquo;</span>
                                			<span aria-hidden="true">Next</span>
                            			</a>
                        			</li>
                    			<?php endif; ?>
                			</ul>
            			</nav>
        			</div>
    			</div>
			</div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


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
document.addEventListener("DOMContentLoaded", function() {
    const priceCheckboxes = document.querySelectorAll('.custom-control-input:not(#price-all)');
    const allPriceCheckbox = document.getElementById('price-all');

    // Add event listeners for all price range checkboxes
    priceCheckboxes.forEach(input => {
        input.addEventListener('change', function() {
            if (this.checked) {
                // If any price range checkbox is checked, uncheck "All Price"
                allPriceCheckbox.checked = false;
            }

            // Call the function to filter products
            filterProducts();
        });
    });

    // Add event listener for the "All Price" checkbox
    allPriceCheckbox.addEventListener('change', function() {
        if (this.checked) {
            // Uncheck all other checkboxes if "All Price" is checked
            priceCheckboxes.forEach(input => {
                input.checked = false;
            });
        }
        // Call the function to filter products
        filterProducts();
    });
});

function filterProducts() {
    const selectedPrices = Array.from(document.querySelectorAll('.custom-control-input:checked')).map(input => {
        return input.id; // Get the ID of checked checkboxes
    });

    // If "All Price" is checked, clear selectedPrices
    if (document.getElementById('price-all').checked) {
        selectedPrices.length = 0; // Clear the array
    }

    // Make an AJAX call to your PHP script to fetch filtered products
    fetch('../Function/filter_products.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({ prices: selectedPrices }) // Send selected prices to the server
	})
	.then(response => {
		if (!response.ok) {
			throw new Error('Network response was not ok');
		}
		return response.json();
	})
	.then(data => {
		console.log(data); // Log the response for debugging
		updateProductList(data); // Update the product display
	})
	.catch(error => console.error('Error fetching products:', error));
}

function updateProductList(products) {
    const productList = document.getElementById('product-list');
    productList.innerHTML = ''; // Clear existing products

    if (products.length > 0) {
    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('col-lg-4', 'col-md-6', 'col-sm-12', 'pb-4'); // Adjust padding for better spacing

        const card = document.createElement('div');
        card.classList.add('card', 'product-item', 'border-0', 'mb-4', 'h-100');

        const cardHeader = document.createElement('div');
        cardHeader.classList.add('card-header', 'product-img', 'position-relative', 'bg-transparent', 'border', 'p-0');

        const imgContainer = document.createElement('div');
        imgContainer.classList.add('img-container'); // Adjust the image container size

        const img = document.createElement('img');
        img.classList.add('img-fluid', 'w-100');
        img.src = product.Image ? product.Image : '../Products/default.png';
        img.alt = product.ProductName;

        imgContainer.appendChild(img);
        cardHeader.appendChild(imgContainer);

        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body', 'border-left', 'border-right', 'text-center', 'p-2'); // Adjust padding inside the card

        const productName = document.createElement('h6');
        productName.classList.add('text-truncate', 'mb-2'); // Reduce the margin-bottom to tighten spacing
        productName.textContent = product.ProductName;

        const price = document.createElement('div');
        price.classList.add('d-flex', 'justify-content-center', 'mb-2'); // Adjust margin-bottom for better spacing

        const priceText = document.createElement('h6');
        priceText.textContent = `RM${product.Price}`;

        price.appendChild(priceText);
        cardBody.appendChild(productName);
        cardBody.appendChild(price);

        const cardFooter = document.createElement('div');
        cardFooter.classList.add('card-footer', 'd-flex', 'justify-content-between', 'bg-light', 'border', 'p-2'); // Adjust footer padding

        const productId = product.ProductID;
        const viewDetail = document.createElement('a');
        viewDetail.href = `detail.php?id=${productId}`;
        viewDetail.classList.add('btn', 'btn-sm', 'text-dark', 'p-0');

        const viewDetailIcon = document.createElement('i');
        viewDetailIcon.classList.add('fas', 'fa-eye', 'text-primary', 'mr-1');

        viewDetail.appendChild(viewDetailIcon);
        viewDetail.appendChild(document.createTextNode('View Detail'));

        cardFooter.appendChild(viewDetail);
        cardFooter.appendChild(addToCart);

        card.appendChild(cardHeader);
        card.appendChild(cardBody);
        card.appendChild(cardFooter);

        productDiv.appendChild(card);
        productList.appendChild(productDiv);
    });
} else {
    productList.innerHTML = '<p style="margin-left: 35px;">No products found.</p>';
}

}
</script>
</body>

</html>