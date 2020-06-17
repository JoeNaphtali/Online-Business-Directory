<html lang="en">

    <head>

		<title>Home | FindUs</title>
        <meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
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
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/script.js"></script>

	</head>

	<body>

		<!-- Navigation Bar -->

		<nav class="navbar navbar-light navbar-expand-lg bg-faded justify-content-center static-top">
			<a href="index.php" class="navbar-brand d-flex w-50 mr-auto">FindUs</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item current">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="businesses/index.php">Businesses</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="deals/index.php">Deals</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="events/index.php">Events</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<a class="btn btn-addlisting" href="#">Add Listing</a>
					<a class="btn btn-login" href="login/index.php">Login</a>
				</div>
			</div>
		</nav>

		<!-- /.Navigation Bar -->

		<!-- Header -->

		<header class="masthead">
			<div class="container h-100">
				<div class="row h-100 align-items-center">
				<div class="col-12 text-center">
					<h1 class="font-weight-light">Connect with great local businesses</h1>
					<p class="lead">Use FindUs to locate businesses near you</p>
					<form class="">
						<div class="form-row">
							<div class="form-group col-md-5">
								<input class="form-control" name="search" type="text" 
								placeholder="What are you looking for?"/>
							</div>
							<div class="form-group col-md-5">
								<input class="form-control" name="search" type="text" 
								placeholder="Where?"/>
							</div>
							<div class="form-group col-md-2">
								<button class="btn btn-search">Search</button>
							</div>								
						</div>
					</form>
				</div>
				</div>
			</div>
		</header>

		<!-- /.Header -->

	</body>

</html>