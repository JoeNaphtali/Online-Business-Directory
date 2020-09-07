<?php
    // Start Session
	session_start();
	
	// Database Connection
	include "../includes/dbh.inc.php";
	
	// If the user is logged in, store session varibles 
	if (isset($_SESSION['login'])) {
		header("Location: ../index.php");
		exit;
	}
?>

<html lang="en">

    <head>

		<title>Create New Password | FindUs</title>
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
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="../js/script.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<?php include '../includes/solidnavbar.inc.php' ?>

		<!-- /.Main Navigation -->

        <!-- Login Form -->

		<?php
			// Get 'selector', 'validator' and 'email' address from URL
            $selector = $_GET['selector'];
			$validator = $_GET['validator'];
			$email = $_GET['email'];
			
            if (empty($selector) || empty($validator) || empty($email)) {
				echo '<div class="text-center error-message">
				<p class="text-white">Could validate your reset request. Please submit your request.</p>
				</div>';
				exit();
            }
            else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="login-form col-lg-4 bg-light px-0 shadow">
					<form class="p-4 bg-white" action="../includes/resetpassword.inc.php" method="post">
					<?php
						// Error messages
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "nopassword") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a new password.</p>
								</div>';
							}
							else if ($_GET['error'] == "norepeat") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please repeat password.</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordshort") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password is too short. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordnodigit") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should contain at least one digit. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordnocapitalletter") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should contain at least one capital letter. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordnosmallletter") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should contain at least one small letter. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordwhitespace") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should not contain any whitespace. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordcheck") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your passwords do not match.
								</p>
								</div>';
							}
						}
					?>
						<h3 class="text-center">Create New Password</h3>
						<div class="form-group">
							<input class="form-control" type="text" name="selector" value="<?php echo $selector ?>" hidden>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="validator" value="<?php echo $validator ?>" hidden>
						</div>
						<div class="form-group">
							<input class="form-control" type="email" name="email" value="<?php echo $email ?>" hidden>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input class="form-control" type="password" name="password" required>
						</div>
                        <div class="form-group">
							<label>Repeat New Password</label>
							<input class="form-control" type="password" name="password_repeat" required>
						</div>
                        <div class="form-group">
							<button class="btn btn-block btn-submit" type="submit" name="reset-password">Reset Password</button>
						</div>
					</form>
                </div>
            </div>
        </div>

        <?php
                }
            }
        ?>

		<!-- /.Login Form -->
		
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

	</body>

</html>