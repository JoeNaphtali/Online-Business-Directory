<?php
 	// Start Session
	session_start();
	
	// Database Connection
	include "../includes/dbh.inc.php";
	
	// If the user is logged in, store session varibles 
	if (isset($_SESSION['login'])) {
		$user_id = $_SESSION['user_id'];
		// Retrieve user from 'user' table
		$results = mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id");
		$row = mysqli_fetch_array($results);

		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
		$profile_picture_status = $row['profile_picture_status'];
	}

	// If user is not logged in, return to home page
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">

	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

	<!-- Summernote CSS -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
	<!-- Summernote JS -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>

	<!-- Leaflet.js CSS -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>

	<!-- Leaflet.js Script -->
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	crossorigin=""></script>

	<title>Edit Listing | Find Us</title>

	<!-- Font Awesome -->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Local CSS -->
	<link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

	<?php
		// Check if lisiting id exists in URL
		if(isset($_GET['l_id'])){
			// Get listing id from URL and store it in the listing_id variable
			$listing_id = $_GET['l_id'];
		}
		else {
			// Return user to home page, if the listing page was not accessed by clicking on a particular listing
			header("Location: ../index.php");
		}
		// Select listing from the 'listing' table
		$results = mysqli_query($conn, "SELECT * FROM listing WHERE id=$listing_id");
		$row = mysqli_fetch_array($results);
		// Get latitude and longitude of listing
		$latitude = $row["latitude"];
		$longtitude = $row["longtitude"];
	?>

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<div class="sidebar-brand-text mx-3">FindUs</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="index.php">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Listings
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item active">
				<a class="nav-link" href="addlisting.php">
				<i class="fas fa-fw fa-plus-circle"></i>
				<span>Add Listing</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="mylistings.php">
				<i class="fas fa-fw fa-layer-group"></i>
				<span>My Listings</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="mybookmarks.php">
				<i class="fas fa-fw fa-heart"></i>
				<span>Bookmarks</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Account
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="myprofile.php">
				<i class="fas fa-fw fa-user-alt"></i>
				<span>My Profile</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="../includes/logout.inc.php">
				<i class="fas fa-fw fa-sign-out-alt"></i>
				<span>Logout</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!--  /.Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Return to home -->
						<li class="nav-item mx-1">
							<a class="nav-link" href="../index.php">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Back to home page</span><i class="fas fa-home fa-fw"></i>
							</a>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Edit Listing</h1>
					</div>

					<!-- Content Row -->
					<div class="row">

						<div class="col-md-12">

							<!-- 'Add Listing' Form -->
							<form class="add-listing" enctype="multipart/form-data" method="POST" action="../includes/addlisting.inc.php">

								<!-- Basic Information -->
								<div class="add-listing-section basic-info shadow">
									<div class="add-listing-headline">
										<span>Basic Information</span>
									</div>
									<div class="add-listing-container">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="listing-name">Listing Name</label>
												<?php if (isset($_GET['lname'])): ?>
												<input type="text" id="listing-name" class="form-control" name="listing_name" value="<?php echo($_GET['lname']) ?>">
												<?php else: ?>
												<input type="text" id="listing-name" class="form-control" name="listing_name" value="<?php echo $row['listing_name'] ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-6">
												<label for="category">Category</label>
												<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
												<select class="form-control" id="category" name="category[]">
													<?php 
														// Store category id in category_id variable
														$category_id = $row["category_id"];
														// Select category from 'listing_category'
														$results_category = mysqli_query($conn, "SELECT * FROM listing_category WHERE id = $category_id"); 
														$row_category = mysqli_fetch_array($results_category);
														$category = $row_category["category"];
													?>
													<option selected value="<?php echo $category_id ?>"><?php echo $category ?></option>
													<?php 
													// Select all catergories from the 'listing_category' table and list them in the dropdown-list
													$results = mysqli_query($conn, "SELECT * FROM listing_category");
													while ($category_row = mysqli_fetch_array($results)) { ?>
													<option value="<?php echo $category_row['id']; ?>"><?php echo $category_row['category']; ?></option>	
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="keywords">Keywords (Optional)</label>
											<i class="fa fa-question-circle fa-fw" data-toggle="tooltip" title="Maximum of 15 keywords related to your business, separated by a comma. These keywords will help users search for your listing."></i>
											<input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo $row['keywords'] ?>">
										</div>
										<div class="form-group">
											<label for="description">Description</label>
											<?php if (isset($_GET['desc'])): ?>
											<textarea class="form-control" id="summernote" name="description"><?php echo ($_GET['desc']); ?></textarea>
											<?php else :?>
											<textarea class="form-control" id="summernote" name="description"><?php echo $row['overview'] ?></textarea>
											<?php endif ?>
										</div>
										<!--
										<div class="form-group">
											<label>Date & Time</label>
											<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
												<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
												</div>
											</div>
										</div>
										-->
									</div>
								</div>
								
								<!-- Location Information -->
								<div class="add-listing-section location shadow">
									<div class="add-listing-headline">
										<span>Location</span>
									</div>
									<div class="add-listing-container">
										<div class="map-container">
											<div id="map"></div>
										</div>
										<div class="form-row">
											<div class="col-md-6">
												<label for="province">Province</label>
												<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
												<select id="province" class="form-control" name="province[]">
													<option selected value="<?php echo $row['province'] ?>"><?php echo $row['province'] ?></option>
													<option value="Lusaka">Lusaka</option>
													<option value="Copperbelt">Copperbelt</option>
													<option value="Southern">Southern</option>
													<option value="Western">Western</option>
													<option value="Central">Central</option>
													<option value="Eastern">Eastern</option>
													<option value="Northern">Northern</option>
													<option value="North-western">North-Western</option>
													<option value="Muchinga">Muchinga</option>
													<option value="Luapula">Luapula</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="citytown">City/Town</label>
												<?php if (isset($_GET['citytown'])) :?>
												<input type="text" class="form-control" id="citytown" name="city_town" value="<?php echo ($_GET['citytown']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="citytown" name="city_town" value="<?php echo $row['city_town']; ?>">
												<?php endif ?>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="address">Address</label>
												<?php if (isset($_GET['address'])) :?>
												<input type="text" class="form-control" id="address" name="address" value="<?php echo ($_GET['address']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="address" name="address" value="<?php echo $row['listing_address']; ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-6">
												<label for="friendly-address">Friendly Address (Optional)</label>
												<i class="fa fa-question-circle fa-fw" data-toggle="tooltip" title="A human readable address e.g A place near where your listing is located."></i>
												<?php if (isset($_GET['faddress'])) :?>
												<input type="text" class="form-control" id="friendly-address" name="friendly_address" value="<?php echo ($_GET['faddress']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="friendly-address" name="friendly_address" value="<?php echo $row['friendly_address']; ?>">
												<?php endif ?>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="latitude">Latitude</label>
												<?php if (isset($_GET['lat'])) :?>
												<input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo ($_GET['lat']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-6">
												<label for="longitude">Longitude</label>
												<?php if (isset($_GET['long'])) :?>
												<input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo ($_GET['long']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $longtitude ?>">
												<?php endif ?>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Contact Information -->
								<div class="add-listing-section contact-information shadow">
									<div class="add-listing-headline">
										<span>Contact Information</span>
									</div>
									<div class="add-listing-container">
										<div class="form-row">
											<div class="form-group col-md-4">
												<?php 
													// Select all phone numbers from the 'listing_phone_number' table that match the selected listing
													$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
													$row_phone = mysqli_fetch_array($results_phone)
												?>
												<label for="phone-1"><i class="fa fa-phone-square"></i> Phone 1</label>
												<?php if (isset($_GET['phone_1'])) :?>
												<input type="text" class="form-control" id="phone-1" name="phone_1" value="<?php echo ($_GET['phone_1']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="phone-1" name="phone_1" value="<?php echo $row_phone['phone_number']; ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-4">
												<?php 
													// Select all phone numbers from the 'listing_phone_number' table that match the selected listing
													$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
													$row_phone = mysqli_fetch_array($results_phone)
												?>
												<label for="phone-2"><i class="fa fa-phone-square"></i> Phone 2 (Optional)</label>
												<?php if (isset($_GET['phone_2'])) :?>
												<input type="text" class="form-control" id="phone-2" name="phone_2" value="<?php echo ($_GET['phone_2']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="phone-2" name="phone_2" value="<?php echo $row_phone['phone_number']; ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-4">
												<?php 
													// Select all phone numbers from the 'listing_phone_number' table that match the selected listing
													$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
													$row_phone = mysqli_fetch_array($results_phone)
												?>
												<label for="phone-3"><i class="fa fa-phone-square"></i> Phone 3 (Optional)</label>
												<?php if (isset($_GET['phone_3'])) :?>
												<input type="text" class="form-control" id="phone-3" name="phone_3" value="<?php echo ($_GET['phone_3']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="phone-3" name="phone_3" value="<?php echo $row_phone['phone_number']; ?>">
												<?php endif ?>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="website"><i class="fa fa-link fa-fw"></i> Website (Optional)</label>
												<?php if (isset($_GET['web'])) :?>
												<input type="text" class="form-control" id="website" name="website" value="<?php echo ($_GET['web']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="website" name="website" value="<?php echo $row['website']; ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-6">
												<label for="email"><i class="fa fa-envelope fa-fw"></i> E-mail (Optional)</label>
												<?php if (isset($_GET['email'])) :?>
												<input type="email" class="form-control" id="email" name="email" value="<?php echo ($_GET['email']); ?>">
												<?php else :?>
												<input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
												<?php endif ?>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-4">
												<label for="facebook"><i class="fab fa-facebook-square fa-fw"></i> Facebook (Optional)</label>
												<?php if (isset($_GET['fb'])) :?>
												<input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo ($_GET['fb']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $row['facebook']; ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-4">
												<label for="twitter"><i class="fab fa-twitter-square fa-fw"></i> Twitter (Optional)</label>
												<?php if (isset($_GET['twi'])) :?>
												<input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo ($_GET['twi']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="twiiter" name="twitter" value="<?php echo $row['twitter']; ?>">
												<?php endif ?>
											</div>
											<div class="form-group col-md-4">
												<label for="instagram"><i class="fab fa-instagram-square fa-fw"></i> Instagram (Optional)</label>
												<?php if (isset($_GET['inst'])) :?>
												<input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo ($_GET['inst']); ?>">
												<?php else :?>
												<input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $row['instagram']; ?>">
												<?php endif ?>
											</div>
										</div>
									</div>
								</div>

								<!-- Opening Hours -->
								<div class="add-listing-section opening-hours shadow">
									<div class="add-listing-headline">
										<span>Opening Hours</span>
										<div class="switch">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="opening-hours-switch" name="opening_hours_switch">
												<label class="custom-control-label" for="opening-hours-switch"></label>
											</div>
										</div>
									</div>
									<div class="add-listing-container">
										<p><span class="star">* </span>Toggle the switch if you wish to have your listing's opening and closing hours displayed on the listing page</p>
										<div class="monday">
											<label>Monday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'mon'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-monday" data-target-input="nearest">
														<?php if (isset($_GET['mon_op'])) :?>
														<input type="text" id="monday-open" class="form-control datetimepicker-input" name="monday_open" data-target="#opening-monday" value="<?php echo ($_GET['mon_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="monday-open" class="form-control datetimepicker-input" name="monday_open" data-target="#opening-monday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-monday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-monday" data-target-input="nearest">
														<?php if (isset($_GET['mon_cl'])) :?>
														<input type="text" id="monday-close" class="form-control datetimepicker-input" name="monday_close" data-target="#closing-monday" value="<?php echo ($_GET['mon_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="monday-close" class="form-control datetimepicker-input" name="monday_close" data-target="#closing-monday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-monday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsMonday();">Clear</button>
										</div>
										<hr>
										<div class="tuesday">
											<label>Tuesday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'tue'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-tuesday" data-target-input="nearest">
														<?php if (isset($_GET['tue_op'])) :?>
														<input type="text" id="tuesday-open" class="form-control datetimepicker-input" name="tuesday_open" data-target="#opening-tuesday" value="<?php echo ($_GET['tue_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="tuesday-open" class="form-control datetimepicker-input" name="tuesday_open" data-target="#opening-tuesday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-tuesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-tuesday" data-target-input="nearest">
														<?php if (isset($_GET['tue_cl'])) :?>
														<input type="text" id="tuesday-close" class="form-control datetimepicker-input" name="tuesday_close" data-target="#closing-tuesday" value="<?php echo ($_GET['tue_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="tuesday-close" class="form-control datetimepicker-input" name="tuesday_close" data-target="#closing-tuesday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-tuesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsTuesday();">Clear</button>
										</div>
										<hr>
										<div class="wednesday">
											<label>Wednesday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'wed'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-wednesday" data-target-input="nearest">
														<?php if (isset($_GET['wed_op'])) :?>
														<input type="text" id="wednesday-open" class="form-control datetimepicker-input" name="wednesday_open" data-target="#opening-wednesday" value="<?php echo ($_GET['wed_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="wednesday-open" class="form-control datetimepicker-input" name="wednesday_open" data-target="#opening-wednesday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-wednesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-wednesday" data-target-input="nearest">
														<?php if (isset($_GET['wed_cl'])) :?>
														<input type="text" id="wednesday-close" class="form-control datetimepicker-input" name="wednesday_close" data-target="#closing-wednesday" value="<?php echo ($_GET['wed_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="wednesday-close" class="form-control datetimepicker-input" name="wednesday_close" data-target="#closing-wednesday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-wednesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsWednesday();">Clear</button>
										</div>
										<hr>
										<div class="thursday">
											<label>Thursday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'thu'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-thursday" data-target-input="nearest">
														<?php if (isset($_GET['thur_op'])) :?>
														<input type="text" id="thursday-open" class="form-control datetimepicker-input" name="thursday_open" data-target="#opening-thursday" value="<?php echo ($_GET['thur_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="thursday-open" class="form-control datetimepicker-input" name="thursday_open" data-target="#opening-thursday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-thursday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-thursday" data-target-input="nearest">
														<?php if (isset($_GET['thur_cl'])) :?>
														<input type="text" id="thursday-close" class="form-control datetimepicker-input" name="thursday_close" data-target="#closing-thursday" value="<?php echo ($_GET['thur_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="thursday-close" class="form-control datetimepicker-input" name="thursday_close" data-target="#closing-thursday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-thursday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsThursday();">Clear</button>
										</div>
										<hr>
										<div class="friday">
											<label>Friday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'fri'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-friday" data-target-input="nearest">
														<?php if (isset($_GET['fri_op'])) :?>
														<input type="text" id="friday-open" class="form-control datetimepicker-input" name="friday_open" data-target="#opening-friday" value="<?php echo ($_GET['fri_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="friday-open" class="form-control datetimepicker-input" name="friday_open" data-target="#opening-friday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-friday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-friday" data-target-input="nearest">
														<?php if (isset($_GET['fri_cl'])) :?>
														<input type="text" id="friday-close" class="form-control datetimepicker-input" name="friday_close" data-target="#closing-friday" value="<?php echo ($_GET['fri_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="friday-close" class="form-control datetimepicker-input" name="friday_close" data-target="#closing-friday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-friday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsFriday();">Clear</button>
										</div>
										<hr>
										<div class="saturday">
											<label>Saturday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'sat'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-saturday" data-target-input="nearest">
														<?php if (isset($_GET['sat_op'])) :?>
														<input type="text" id="saturday-open" class="form-control datetimepicker-input" name="saturday_open" data-target="#opening-saturday" value="<?php echo ($_GET['sat_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="saturday-open" class="form-control datetimepicker-input" name="saturday_open" data-target="#opening-saturday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-saturday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-saturday" data-target-input="nearest">
														<?php if (isset($_GET['sat_cl'])) :?>
														<input type="text" id="saturday-close" class="form-control datetimepicker-input" name="saturday_close" data-target="#closing-saturday" value="<?php echo ($_GET['sat_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="saturday-close" class="form-control datetimepicker-input" name="saturday_close" data-target="#closing-saturday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-saturday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsSaturday();">Clear</button>
										</div>
										<hr>
										<div class="sunday">
											<label>Sunday</label>
											<?php
												$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'sun'");
												$row_opening_hours = mysqli_fetch_array($results_opening_hours); 
											?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-sunday" data-target-input="nearest">
														<?php if (isset($_GET['sun_op'])) :?>
														<input type="text" id="sunday-open" class="form-control datetimepicker-input" name="sunday_open" data-target="#opening-sunday" value="<?php echo ($_GET['sun_op']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="sunday-open" class="form-control datetimepicker-input" name="sunday_open" data-target="#opening-sunday" value="<?php echo $row_opening_hours['opening_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#opening-sunday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-sunday" data-target-input="nearest">
														<?php if (isset($_GET['sun_cl'])) :?>
														<input type="text" id="sunday-close" class="form-control datetimepicker-input" name="sunday_close" data-target="#closing-sunday" value="<?php echo ($_GET['sun_cl']); ?>" disabled/>
														<?php else :?>
														<input type="text" id="sunday-close" class="form-control datetimepicker-input" name="sunday_close" data-target="#closing-sunday" value="<?php echo $row_opening_hours['closing_time'] ?>" disabled/>
														<?php endif ?>
														<div class="input-group-append" data-target="#closing-sunday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsSunday();">Clear</button>
										</div>
									</div>
								</div>
								<!-- Product Pricing 
								<div class="add-listing-section pricing shadow">
									<div class="add-listing-headline">
										<span>Pricing</span>
										<div class="switch">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="pricing-switch">
												<label class="custom-control-label" for="pricing-switch"></label>
											</div>
										</div>
									</div>
									<div class="add-listing-container">
										<p><span class="star">* </span>Toggle the switch if you wish to have any products displayed on the listing page</p>
										<div class="form-group" id="items-container">
										
										</div>
										<div class="controls">
											<button class="btn btn-primary pricing-input" type="button" id="add-item" disabled>Add Item</button>
											<button class="btn btn-primary pricing-input" type="button" id="add-category" disabled>Add Category</button>
										</div>
									</div>
								</div> -->
								
								<!-- Ticket Pricing
								<div class="add-listing-section pricing shadow">
									<div class="add-listing-headline">
										<span>Ticket Pricing</span>
										<div class="switch">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="pricing-switch">
												<label class="custom-control-label" for="pricing-switch"></label>
											</div>
										</div>
									</div>
									<div class="add-listing-container">
										<div class="form-group" id="items-container">
									
										</div>
										<div class="controls">
											<button class="btn btn-primary pricing-input" type="button" id="add-item" disabled>Add Item</button>
											<button class="btn btn-primary pricing-input" type="button" id="add-category" disabled>Add Category</button>
										</div>
										<span>* The items entered will appear on the booking page of the event</span>
									</div>
								</div> -->

								<!-- Amenities -->								
								<div class="add-listing-section amenities shadow">
									<div class="add-listing-headline">
										<span>Amenities</span>
										<div class="switch">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="amenities-switch">
												<label class="custom-control-label" for="amenities-switch"></label>
											</div>
										</div>
									</div>
									<div class="add-listing-container">
										<?php 
											// Select listing from the 'listing' table
											$results = mysqli_query($conn, "SELECT * FROM amenity WHERE listing_id=$listing_id AND amenity='Wi-Fi'");
											$row = mysqli_fetch_array($results);
										?>
										<p><span class="star">* </span>Toggle the switch if you wish to have any products displayed on the listing page</p>
										<div class="form-check form-check-inline">
										    <?php if (isset($row['amenity'])): ?>
											<input class="form-check-input amenity" name="wi_fi" id="wi-fi" checked type="checkbox" value="Wi-Fi" disabled>
											<?php else: ?>
											<input class="form-check-input amenity" name="wi_fi" id="wi-fi" type="checkbox" value="Wi-Fi" disabled>
											<?php endif ?>
											<label class="form-check-label" for="wi-fi">Free Wi-FI</label>
										</div>
										<?php 
											// Select listing from the 'listing' table
											$results = mysqli_query($conn, "SELECT * FROM amenity WHERE listing_id=$listing_id AND amenity='Pet Friendly'");
											$row = mysqli_fetch_array($results);
										?>
										<div class="form-check form-check-inline">
										    <?php if (isset($row['amenity'])): ?>
											<input class="form-check-input amenity" checked name="pets" id="pets-allowed" type="checkbox" value="Pet Friendly" disabled>
											<?php else: ?>
											<input class="form-check-input amenity" name="pets" id="pets-allowed" type="checkbox" value="Pet Friendly" disabled>
											<?php endif ?>
											<label class="form-check-label" for="pets-allowed">Pets Allowed</label>
										</div>
										<?php 
											// Select listing from the 'listing' table
											$results = mysqli_query($conn, "SELECT * FROM amenity WHERE listing_id=$listing_id AND amenity='Smoking'");
											$row = mysqli_fetch_array($results);
										?>
										<div class="form-check form-check-inline">
											<?php if (isset($row['amenity'])): ?>
											<input class="form-check-input amenity" checked name="smoking" id="smoking-allowed" type="checkbox" value="Smoking" disabled>
											<?php else: ?>
											<input class="form-check-input amenity" name="smoking" id="smoking-allowed" type="checkbox" value="Smoking" disabled>
											<?php endif ?>
											<label class="form-check-label" for="smoking-allowed">Smoking Allowed</label>
										</div>
									</div>
								</div>

								<button class="btn btn-primary" type="submit" name="update-listing"><i class="fa fa-arrow-circle-right fa-fw"></i> Update Listing</button>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.Content Wrapper -->

	</div>	
	<!-- /.Page Wrapper -->

	<!-- Leaflet Map Script	-->
	<script>
			
		var longtitude  = '<?php echo $longtitude;?>';
		var latitude  = '<?php echo $latitude;?>';
			
		var listing_map = L.map('map').setView([latitude, longtitude], 18);
		var listing_marker = L.marker([latitude, longtitude], { draggable: true }).addTo(listing_map);

		listing_marker.on('dragend', function (e) {
			document.getElementById('latitude').value = listing_marker.getLatLng().lat;
			document.getElementById('longitude').value = listing_marker.getLatLng().lng;
		});

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 16,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
		}).addTo(listing_map);

	</script>

	<!-- Google Map
	<script>
		function initMap() {
			var location = {lat: -25.363, lng: 131.044};
			var map = new google.maps.Map(document.getElementById("map"), {
				zoom: 4,
				center: location
			});
		}
	</script> -->

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5KcYk33GCMh1iuJrYzxynDb9Fx2Tfbaw&callback=initMap"></script>

	<!-- Clear time fields -->
	<script>
		function ClearFieldsMonday() {
			document.getElementById("monday-open").value = "";
			document.getElementById("monday-close").value = "";
		}

		function ClearFieldsTuesday() {
			document.getElementById("tuesday-open").value = "";
			document.getElementById("tuesday-close").value = "";
		}

		function ClearFieldsWednesday() {
			document.getElementById("wednesday-open").value = "";
			document.getElementById("wednesday-close").value = "";
		}

		function ClearFieldsThursday() {
			document.getElementById("thursday-open").value = "";
			document.getElementById("thursday-close").value = "";
		}

		function ClearFieldsFriday() {
			document.getElementById("friday-open").value = "";
			document.getElementById("friday-close").value = "";
		}

		function ClearFieldsSaturday() {
			document.getElementById("saturday-open").value = "";
			document.getElementById("saturday-close").value = "";
		}

		function ClearFieldsSunday() {
			document.getElementById("sunday-open").value = "";
			document.getElementById("sunday-close").value = "";
		}
	</script>

	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="js/sb-admin-2.js"></script>

	<!-- Page level plugins -->
	<script src="vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="js/demo/chart-area-demo.js"></script>
	<script src="js/demo/chart-pie-demo.js"></script>

	<!-- Time picker fields -->
  	<script type="text/javascript">
		$(function () {
			$('#opening-monday').datetimepicker({
				format: 'LT'
			});
			$('#closing-monday').datetimepicker({
				format: 'LT'
			});
			$('#opening-tuesday').datetimepicker({
				format: 'LT'
			});
			$('#closing-tuesday').datetimepicker({
				format: 'LT'
			});
			$('#opening-wednesday').datetimepicker({
				format: 'LT'
			});
			$('#closing-wednesday').datetimepicker({
				format: 'LT'
			});
			$('#opening-thursday').datetimepicker({
				format: 'LT'
			});
			$('#closing-thursday').datetimepicker({
				format: 'LT'
			});
			$('#opening-friday').datetimepicker({
				format: 'LT'
			});
			$('#closing-friday').datetimepicker({
				format: 'LT'
			});
			$('#opening-saturday').datetimepicker({
				format: 'LT'
			});
			$('#closing-saturday').datetimepicker({
				format: 'LT'
			});
			$('#opening-sunday').datetimepicker({
				format: 'LT'
			});
			$('#closing-sunday').datetimepicker({
				format: 'LT'
			});
		});
	</script>

	<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>

<script>
			
			const listingPicture = document.getElementById("listing_picture");
			const previewContainer = document.getElementById("imagePreview");
			const previewImage = previewContainer.querySelector(".image-preview__image");
			const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

			listingPicture.addEventListener("change", function() {
				const file = this.files[0];

				if (file) {
					const reader = new FileReader();
					previewDefaultText.style.display = "none";
					previewImage.style.display = "block";

					reader.addEventListener("load", function() {
						previewImage.setAttribute("src", this.result);
					});

					reader.readAsDataURL(file);
				}
				else {
					previewDefaultText.style.display = null;
					previewImage.style.display = null;
					previewImage.setAttribute("src", "");
				}
			});

		</script>

</body>

</html>
