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
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
    /* Frame for profile picture */
    .profile-frame {
        width: 150px;
        height: 150px;
        border: 3px solid #ccc; /* Customize the frame border */
        border-radius: 50%; /* Makes the frame circular */
        overflow: hidden; /* Ensures the image stays within the frame */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Profile photo styling */
    .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the frame without stretching */
    }
	
	/* Inline error message styles */
    .text-danger {
        color: #dc3545; /* Bootstrap red for errors */
        font-size: 16px; /* Increase font size for better visibility */
        margin-top: 5px; /* Add space between the error message and the input field */
    }

    /* Additional spacing for contact number error */
    .form-group .text-danger#contactError {
        margin-top: 10px; /* Adjust spacing specifically for contact number */
    }
	
	.button-container {
    display: flex;
    gap: 1rem; /* Adjust the space between the buttons as needed */
    margin-top: 1rem; /* Add space above the button container */
	}
</style>
<body>
	<?php
	session_start();
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
                                href="../CG/index.php" aria-expanded="false"><i class="mdi mdi-home"></i><span
                                    class="hide-menu">Homepage</span></a></li>
                        <li class="text-center p-40 upgrade-btn">
                        
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
                        <h4 class="page-title">Profile Page</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7">
                       
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
								<?php
                                if (isset($_SESSION['profilePhoto'])) {
                                    echo '<center class="m-t-30">
                                        <div class="profile-frame">
                                            <img src="../Uploads/' . htmlspecialchars($_SESSION['profilePhoto']) . '" class="profile-photo" alt="User Profile Picture">
                                        </div>
                                    </center>';
                                } else {
                                    echo '<center class="m-t-30">
                                        <div class="profile-frame">
                                            <img src="../Uploads/default.jpg" class="profile-photo" alt="Default Profile Picture">
                                        </div>
                                    </center>';
                                }
                                ?>
                                    <h4 class="card-title m-t-10"><?php echo htmlspecialchars($_SESSION['username']); ?></h4>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                                    class="icon-people"></i>
                                                <font class="font-medium"></font>
                                            </a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                                    class="icon-picture"></i>
                                                <font class="font-medium"></font>
                                            </a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?php echo htmlspecialchars($_SESSION['email']); ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?php echo htmlspecialchars($_SESSION['contact']); ?></h6><br>
                                <form action="../Function/Upload.php" method="post" enctype="multipart/form-data" id="photoForm">
									<label for="profilePhoto" class="btn btn-success text-white" id="uploadButton">Upload Profile Photo</label>
									<input type="file" name="profilePhoto" id="profilePhoto" accept="image/*" style="display: none;">
								</form>
                                <div class="map-box">
                                   
                                </div> <small class="text-muted p-t-30 db"></small>
                                <br />
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action = "../Function/Editprofile.php" method = "POST" onsubmit="return validateForm()">
                                    <div class="form-group">
										<label class="col-md-12">Username</label>
										<div class="col-md-12">
											<input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" class="form-control form-control-line" required>
											<span id="usernameError" class="text-danger"></span> <!-- Inline error message -->
										</div>
									</div>
									<div class="form-group">
										<label for="example-email" class="col-md-12">Email</label>
										<div class="col-md-12">
											<input type="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" class="form-control form-control-line" name="email" id="email" readonly>
											<span id="emailError" class="text-danger"></span> <!-- Inline error message -->
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Phone No</label>
										<div class="col-md-12">
											<input type="number" value="<?php echo htmlspecialchars($_SESSION['contact']); ?>" class="form-control form-control-line" name="contact_number" required>
											<span id="contactError" class="text-danger"></span> <!-- Inline error message -->
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Address</label>
										<div class="col-md-12">
											<input type="text" value="<?php echo htmlspecialchars($_SESSION['address']); ?>" class="form-control form-control-line" name="address" required>
											<span id="addressError" class="text-danger"></span> <!-- Inline error message -->
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<div class="button-container">
												<button class="btn btn-success text-white" name="update_profile">Update Profile</button>
    											<button class="btn btn-success text-white" onclick="window.location.href='../CG/Changepasswordform.html'">Change Password</button>
											</div>
										</div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                &copy; 2024 UTM Advance
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
	<script>
    // Trigger file input when the button is clicked
    document.getElementById('uploadButton').addEventListener('click', function(event) {
        event.preventDefault();  // Prevent the default button action
        document.getElementById('profilePhoto').click();  // Open the file dialog
    });

    // Submit the form when the user selects a file
    document.getElementById('profilePhoto').addEventListener('change', function() {
        document.getElementById('photoForm').submit();  // Submit the form on file selection
    });
	</script>
	<script>
    function validateForm() {
        // Clear previous error messages
        document.getElementById('usernameError').textContent = '';
        document.getElementById('contactError').textContent = '';
        document.getElementById('addressError').textContent = '';

        // Get all input fields
        var username = document.querySelector('input[name="username"]').value.trim();
        var contact_number = document.querySelector('input[name="contact_number"]').value.trim();
        var address = document.querySelector('input[name="address"]').value.trim();

        var isValid = true;

        // Check if any field is empty
        if (username === "" || contact_number === "" || address === "") {
            if (username === "") {
                document.getElementById('usernameError').textContent = 'Username is required.';
            }
            if (contact_number === "") {
                document.getElementById('contactError').textContent = 'Phone number is required.';
            }
            if (address === "") {
                document.getElementById('addressError').textContent = 'Address is required.';
            }
            isValid = false; // Prevent form submission
        }
        
        // Phone number validation
        var phonePattern = /^\d{10,11}$/;
        if (!phonePattern.test(contact_number)) {
            document.getElementById('contactError').textContent = 'Phone number must be between 10 and 11 digits long.';
            isValid = false;
        }
    
        // If all fields are valid, allow form submission
        return isValid;
    }
	</script>
</body>

</html>