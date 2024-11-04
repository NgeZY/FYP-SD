<?php
ob_start();
session_start();
ob_end_flush();

require('../Function/config.php');

// SQL query to fetch data from the order table
$query = "SELECT * FROM `order`";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

// If there's a success message stored in the session, display it as an alert
if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']); 
}

// Unset any session variables related to product details, if they exist
unset($_SESSION['orderID'], $_SESSION['customerName'], $_SESSION['email'], $_SESSION['total'], $_SESSION['orderDate'], $_SESSION['status'], $_SESSION['shippingAddress']);

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
</head>


<style>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 0.25rem;
        overflow: hidden;
        padding: 1.25rem;
    }

    .card-body {
        padding: 0;
    }
    
    .card-body .btn {
        margin-bottom: 1rem;
    }

    .table {
        border-collapse: collapse !important;
        width: 100%;
        margin-bottom: 0;
    }
</style>

<body>
<?php
	$role = $_SESSION['role'];
	?>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        
        <!-- Topbar header -->
        <header class="topbar" data-navbarbg="">
		<nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="index.php">
                <!-- Logo icon -->
                <img src="../CG/img/UTM.png" alt="" style="height: 40px; width: auto;">
                <!-- End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- Sidebar toggle (visible on mobile only) -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="">
            <!-- ============================================================== -->
            <!-- Nav items and right side controls -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
                <!-- Optional: Add items to the left side if needed -->
            </ul>
            <ul class="navbar-nav float-end" style="font-size: 16px;">
			<!-- Sign out button -->
			<a href="../Function/Signout.php" class="nav-item nav-link" style="color: #000000;">Sign Out</a>
			</ul>

			</div>
		</nav>
	</header>

        <!-- Left Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
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
                                href="ViewSalesReport.php" aria-expanded="false"><i class="mdi mdi-file"></i><span
                                    class="hide-menu">Sales Report</span></a></li>
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
        </aside>

        <!-- Page wrapper -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Order Details</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="Product.php">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Container fluid -->
 <?php
require('../Function/config.php'); // Include your database configuration
session_start(); // Start the session

// Get the OrderID from the query parameters
$orderID = $_GET['OrderID'] ?? null; // Get OrderID from the URL

// Check if OrderID is provided
if ($orderID === null) {
    echo "<script>alert('No Order ID provided. Please select an order to view the details.'); window.location.href = 'OrderList.php';</script>";
    exit();
}

// Prepare the SQL query to fetch order details
$sql = "SELECT o.OrderID, o.CustomerName, o.Email, o.Total, o.OrderDate, o.Status, o.ShippingAddress, 
               oi.ProductID, oi.Quantity, oi.Price, oi.Size, p.ProductName
        FROM `order` o
        JOIN order_items oi ON o.OrderID = oi.OrderID
        JOIN product p ON oi.ProductID = p.ProductID
        WHERE o.OrderID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('i', $orderID); // Bind OrderID as an integer
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include your Bootstrap CSS -->
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order Details for Order ID: <?php echo htmlspecialchars($orderID); ?></h4>
                    <?php
                    // Check if any order details exist
                    if ($result->num_rows > 0) {
                        // Fetch order header
                        $order = $result->fetch_assoc();
                        ?>
                        <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($order['CustomerName']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($order['Email']); ?></p>
                        <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['OrderDate']); ?></p>
                        <p><strong>Total:</strong> RM <?php echo number_format($order['Total'], 2); ?></p>
                        <p><strong>Status:</strong> <?php echo htmlspecialchars($order['Status']); ?></p>
                        <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($order['ShippingAddress']); ?></p>

                        <h5 class="mt-4">Order Items:</h5>
                        <table class="table table-bordered" style="background-color: #FFFFFF;">
                            <thead>
                                <tr style="background-color: #f09e9a; color: white;">
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price (RM)</th>
                                    <th>Total (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        // Reset the result pointer and fetch all order items
                        $result->data_seek(0); // Move the pointer back to the beginning
                        while ($item = $result->fetch_assoc()) {
                            $itemTotal = $item['Price'] * $item['Quantity'];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['ProductName']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['Size']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['Quantity']) . "</td>";
                            echo "<td>RM " . number_format($item['Price'], 2) . "</td>";
                            echo "<td>RM " . number_format($itemTotal, 2) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "<p>No order details found for this Order ID.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Close the statement and connection
$stmt->close();
$con->close();
?>

<script src="path/to/bootstrap.bundle.js"></script> <!-- Include your Bootstrap JS -->
</body>
</html>

            <!-- End Container fluid -->
            <footer class="footer text-center">
                &copy; 2024 UTM Advance
            </footer>
        </div>
        <!-- End Page wrapper -->
    </div>
    <!-- End Main wrapper -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.js"></script>
</body>
</html>
