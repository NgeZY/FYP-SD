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
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Xtreme lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>UTM Advance</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<?php
	$role = $_SESSION['role'];
	?>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
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

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
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
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"></li>
									
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="text-end upgrade-btn">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
<?php include '../Function/config.php'; // Database connection ?>

<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Top Selling Products</h4>
                        <h5 class="card-subtitle">Overview of Top Selling Items</h5>
                    </div>
                    <div class="ms-auto">
                        <div class="dl">
                            <select class="form-select shadow-none">
                                <option value="0" selected>Monthly</option>
                                <option value="1">Daily</option>
                                <option value="2">Weekly</option>
                                <option value="3">Yearly</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- title -->
            </div>
            <div class="table-responsive">
                <table class="table v-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-top-0">Products</th>
                            <th class="border-top-0">Sales</th>
                            <th class="border-top-0">Earnings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to fetch the top 4 highest-sold products
                        $sql = "SELECT p.ProductName, SUM(oi.Quantity) AS Sales, SUM(oi.Quantity * oi.Price) AS Earnings
                                FROM order_items oi
                                JOIN product p ON oi.ProductID = p.ProductID
                                GROUP BY p.ProductName
                                ORDER BY Sales DESC
                                LIMIT 4";

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            // Loop through the result and display each product
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10">
                                                    <a class="btn btn-circle d-flex btn-info text-white">P</a>
                                                </div>
                                                <div>
                                                    <h4 class="m-b-0 font-16">' . htmlspecialchars($row['ProductName']) . '</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td>' . $row['Sales'] . '</td>
                                        <td>RM ' . number_format($row['Earnings'], 2) . '</td>
                                    </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='3'>No data available.</td></tr>";
                        }

                        $con->close(); // Close the database connection
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Feedbacks</h4>
                            </div>
                            <div class="comment-widgets scrollable">
							<?php
                                // Database connection
                                require '../Function/config.php';

                                // SQL query to retrieve feedback
                                $sql = "SELECT Name, Email, Message FROM feedback LIMIT 4"; // Assuming 'id' is the primary key in the feedback table
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
   
									while($row = $result->fetch_assoc()) {
										echo "<div class='comment-text w-100'>
												<h6 style = 'font-size: 20px;'>" . htmlspecialchars($row["Name"]) . "</h6>
												<span style = 'font-size: 15px;'>" . htmlspecialchars($row["Message"]) . "</span>
												<span class='m-b-15 d-block'>Email: ". htmlspecialchars($row["Email"]) . "</span>
											</div>";
									}
                                } else {
                                    echo "<p>No feedback available.</p>";
                                }

                                // Close connection
                                $con->close();
                            ?>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                   
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                &copy; 2024 UTM Advance.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>