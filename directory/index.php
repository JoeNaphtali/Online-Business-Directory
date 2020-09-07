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
?>

<html lang="en">

    <head>

        <title>Directory | FindUs</title>
        <meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- Leaflet.js CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
        <!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- Leaflet.js Script -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
		<!-- Local Script -->
        <script type="text/javascript" src="../js/main.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<!-- Main Navigation -->

		<nav class="navbar navbar-light solid-navbar navbar-expand-lg fixed-top">
			<a href="../index.php" class="navbar-brand d-flex w-50 mr-auto js-scroll-trigger">FindUs</a>
			<button class="navbar-toggler hamburger-icon" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php 
				if (isset($_SESSION['login'])) {
					echo "<div class='navbar-mobile-buttons'>
					<div class='dropdown dropdown-mobile'>
						<a href='#' class='btn-myaccount dropdown-toggle text-decoration-none' id='navbarDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href='#'>";
						if ($profile_picture_status == true) {
							$filename = "../img/profile_pictures/profile_picture_user_".$user_id."*";
							$fileinfo = glob($filename);
							$fileext = explode("_".$user_id.".", $fileinfo[0]);
							$fileactualext = $fileext[1];
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."'>";
						}
						else {
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_default.png'>";
						}
						echo "</a><div class='dropdown-menu user-dropdown-menu' id='dropdown-menu' aria-labelledby='navbarDropdown'>
							<a class='dropdown-item' href='../dashboard/index.php'><i class='fa fa-cog fa-fw'></i> Dashboard</a>
							<a class='dropdown-item' href='../dashboard/mylistings.php'><i class='fa fa-layer-group fa-fw'></i> My Listings</a>
							<a class='dropdown-item' href='../dashboard/mylistings.php'><i class='fa fa-user fa-fw'></i> My Profile</a>
							<form action='../includes/logout.inc.php' method='post'>
								<button class='dropdown-item' name='logout'><i class='fa fa-sign-out-alt fa-fw'></i> Log out</button>
							</form>
						</div>
					</div>
				</div>";
				}
			?>
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item current">
						<a class="nav-link js-scroll-trigger" href="../directory/index.php">Directory</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="../blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<?php
					if (isset($_SESSION['login'])) {
						echo '<div class="navbar-buttons"><div class="dropdown no-arrow cart"><div class="dropdown"><a class="btn-myaccount dropdown-toggle text-decoration-none" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">';
						if ($profile_picture_status == true) {
							$filename = "../img/profile_pictures/profile_picture_user_".$user_id."*";
							$fileinfo = glob($filename);
							$fileext = explode("_".$user_id.".", $fileinfo[0]);
							$fileactualext = $fileext[1];
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."'>";
						}
						else {
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_default.png'>";
						}
								
						echo '</a>
						<div class="dropdown-menu user-dropdown-menu" id="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../dashboard/index.php"><i class="fa fa-cog fa-fw"></i> Dashboard</a>
							<a class="dropdown-item" href="../dashboard/mylistings.php"><i class="fa fa-layer-group fa-fw"></i> My Listings</a>
							<a class="dropdown-item" href="../dashboard/mylistings.php"><i class="fa fa-user fa-fw"></i> My Profile</a>
							<form action="../includes/logout.inc.php" method="post">
								<button class="dropdown-item" name="logout"><i class="fa fa-sign-out-alt fa-fw"></i> Log out</button>
							</form>
						</div>
					</div>
					</div>';
					}
					else {
						echo '<a class="btn btn-login" href="../login/index.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>
						';
					}
					?>
					<?php
					if (isset($_SESSION['login'])) {
						echo '<a class="btn btn-addlisting" href="../dashboard/addlisting.php"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
					}
					else {
						echo '<a class="btn btn-addlisting" data-toggle="modal" data-target="#login-prompt"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>
						';
					}
					?>
				</div>
			</div>
		</nav>

		<!-- /.Main Navigation -->

		<!-- /.Main Navigation -->

		<!-- Content -->

		<div class="fs-container">
			<div class="fs-inner-container search-container">
				<section class="search">
					<form id="search-form-form">
						<div class="form-row">
							<div class="form-group col-md-6">
								<input type="text" class="form-control" placeholder="What are you looking for?">
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" placeholder="Location">
							</div>
						</div>
						<div class="form-group">
							<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
							<select class="form-control" name="" id="">
								<option value="">All Categories</option>
								<option value="">Hotels</option>
								<option value="">Restaurant</option>
								<option value="">Eat &amp; Drink</option>
								<option value="">Events</option>
								<option value="">Fitness</option>
								<option value="">Others</option>
							</select>
						</div>
						<div class="form-group">
							<button class="btn btn-search">Search</button>
						</div>
						<div class="dropdown-panel distance-radius">
							<a href="#" class="dropdown-panel-toggle">Distance Radius <i class="fa fa-chevron-down"></i></a>
							<div class="dropdown-panel-content">
								<div class="form-group">
									<span>Distance Radius</span>
									<input disabled class="distanceRangeInput" type="range" name="distanceRangeInput" id="distanceRangeInput" value="50" min="1" max="100" oninput="distanceRangeOutput.value = distanceRangeInput.value">
									<output name="distanceRangeOutput" id="distanceRangeOutput">50</output>
								</div>
								<label for="enableDistanceRadius">Enable</label>
								<input id="enableDistanceRadius" type="checkbox">
							</div>
						</div>
					</form>
				</section>
				<section class="listings-container padding-top-30">
					<div class="sort-by padding-left-right-30">
						<div class="sort-listing">
							<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
							<select class="" name="" id="">
								<option value="">Top Rated</option>
								<option value="">Most Reviews</option>
								<option value="">Most Views</option>
								<option value="">Newest Listings</option>
								<option value="">Old Listings</option>
							</select>
						</div>
					</div>
					<div class="padding-left-right-30 margin-bottom-15 margin-top-15">
						Showing results for 'food'
					</div>
					<div class="listings padding-left-right-30">
						<div class="row">
							<div class="col-xl-6 col-xl-6">
								<div class="card mb-4 listing-item listing-item-small shadow">
									<div class="listing-item-pic set-bg" data-setbg="../img/listing/list-1.jpg">
										<div class="listing-details">
											<h2 class="card-title">Burger House</h2>
											<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
											<div><i class="fa fa-phone fa-fw"></i> (+12) 345-678-910</div>
										</div>
										<div class="listing-category category">
											<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
										</div>
										<div class="listing-badge open">
											Open
										</div>
										<div class="bookmark">
											<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
										</div>
									</div>
									<div class="card-footer listing-rating text-muted">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-alt"></i>
										<span> (1 review)</span>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-xl-6">
								<div class="card mb-4 listing-item listing-item-small shadow">
									<div class="listing-item-pic set-bg" data-setbg="../img/listing/list-1.jpg">
										<div class="listing-details">
											<h2 class="card-title">Burger House</h2>
											<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
											<div><i class="fa fa-phone fa-fw"></i> (+12) 345-678-910</div>
										</div>
										<div class="listing-category category">
											<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
										</div>
										<div class="listing-badge open">
											Open
										</div>
										<div class="bookmark">
											<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
										</div>
									</div>
									<div class="card-footer listing-rating text-muted">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-alt"></i>
										<span> (1 review)</span>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-xl-6">
								<div class="card mb-4 listing-item listing-item-small shadow">
									<div class="listing-item-pic set-bg" data-setbg="../img/listing/list-1.jpg">
										<div class="listing-details">
											<h2 class="card-title">Burger House</h2>
											<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
											<div><i class="fa fa-phone fa-fw"></i> (+12) 345-678-910</div>
										</div>
										<div class="listing-category category">
											<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
										</div>
										<div class="listing-badge open">
											Open
										</div>
										<div class="bookmark">
											<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
										</div>
									</div>
									<div class="card-footer listing-rating text-muted">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-alt"></i>
										<span> (1 review)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="copyrights">
						© Joseph Wamulume, 2020. All Rights Reserved.
					</div>
				</section>

			</div>
			<div class="fs-inner-container map-container">
				<div id="map"></div>
			</div>
		</div>

		<!-- /.Content -->

		<!-- Footer

		<div class="pt-5 pb-5 footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-xs-12 footer-section about-company">
						<h2>FindUs</h2>
						<p class="pr-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ante mollis quam tristique convallis </p>
						<p class="footer-social-icons"><a href="#"><i class="fab fa-facebook fa-2x"></i></a>
						<a href="#"><i class="fab fa-twitter fa-2x"></i></a>
						<a href="#"><i class="fab fa-instagram fa-2x"></i></a>
						<a href="#"><i class="fab fa-linkedin fa-2x"></i></a>
						<a href="#"><i class="fab fa-google fa-2x"></i></a>
						</p>
					</div>
					<div class="col-lg-3 col-xs-12 footer-section links">
						<h4 class="mt-lg-0 mt-sm-3">Links</h4>
						<ul class="m-0 p-0">
							<li><a href="#">About FindUs</a></li>
							<li><a href="#">Contact us</a></li>
							<li><a href="#">Content Guidelines</a></li>
							<li><a href="#">Terms of Service</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-xs-12 footer-section location">
						<h4 class="mt-lg-0 mt-sm-4">Sign up for our newsletter</h4>
						<form>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" required>
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-submit" type="submit" name="newsletter-submit">Sign up</button>
							</div>
						</form>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col copyright">
					<p class=""><small>© Joseph Wamulume, 2020. All Rights Reserved.</small></p>
					</div>
				</div>
			</div>
		</div>

		/.Footer -->

		<script>

		var search_map = L.map('map').setView([-15.386283, 28.399378], 17);
		var search_marker = L.marker([-15.386283, 28.399378]).addTo(search_map);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
		}).addTo(search_map);

		setInterval(function () {

		search_map.invalidateSize();

		}, 100);
		
		</script>

	</body>

</html>