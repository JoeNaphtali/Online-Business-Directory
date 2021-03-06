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

		<title>Blog | FindUs</title>
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
		<script type="text/javascript" src="../js/main.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<?php include '../includes/solidnavbar.inc.php' ?>

		<!-- /.Main Navigation -->

		<!-- Content -->

		<div class="container">
			<div class="row">
				<!-- Blog Entries Column -->
      			<div class="col-lg-8 blog-enteries-column blog-post">
					
				  	<!-- Blog post meta date -->
					<div class="blog-post-info">
						<h1>Post title</h1>
						<span><i class="fa fa-calendar-alt fa-fw"></i> 4th July, 2020</span>
						<span><i class="fa fa-pen-nib fa-fw"></i> Joseph Wamulume</span>
						<span><i class="fa fa-folder-open fa-fw"></i> Travel</span>
					</div>

                    <!-- Preview Image -->
                    <div class="blog-post-pic set-bg" data-setbg="../img/blog/details/blog-video-bg.jpg">
					</div>
					
					<hr>

                    <!-- Post Content -->
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

                    <blockquote class="blockquote">
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">Someone famous in
                        <cite title="Source Title">Source Title</cite>
                    </footer>
                    </blockquote>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

                    <hr>

					<div class="row">
						<div class="blog-tags col-md-6">
							<a href="#"><i class="fa fa-tag fa-fw"></i> Business</a>
							<a href="#"><i class="fa fa-tag fa-fw"></i> Marketing</a>
							<a href="#"><i class="fa fa-tag fa-fw"></i> Payment</a>
						</div>
						
						<div class="share-social-icons col-md-6">
							<a href="#" class="facebook" data-toggle="tooltip" data-placement="top" title="Share on Facebook"><i class="fab fa-facebook-f fa-fw"></i></a>
							<a href="#" class="twitter" data-toggle="tooltip" data-placement="top" title="Share on Twitter"><i class="fab fa-twitter fa-fw"></i></a>
							<a href="#" class="link" data-toggle="tooltip" data-placement="top" title="Copy link"><i class="fa fa-link fa-fw"></i></a>
						</div>
					</div>

					<!-- Comment Forms -->

					<!-- About Author -->
					<div class="about-author">
						<div class="author-pic">
							<img src="../img/user-profile-avatar.jpg">
						</div>
						<div class="author-info">
							<span class="author-name">Joseph Wamulume</span>
							<span class="author-posts"><a href="#">View all posts by Joseph Wamulume</a></span>
							<span class="author-bio">Quisque rhoncus tellus et suscipit pellentesque. 
							Donec viverra eros sed justo dignissim laoreet. Aenean justo risus, 
							imperdiet id massa ac, convallis condimentum risus.</span>
						</div>
					</div>

					<hr>

					<div class="row blog-section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Related Posts</h2>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div>
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<div class="card mb-4 blog-item shadow">
											<div class="blog-item-pic set-bg" data-setbg="../img/blog/blog-large.jpg">
												<div class="blog-item-date">
													<span class="month">Jul</span>
													<span class="day">05</span>
												</div>
												<div class="blog-item-category category">
													<a href="#"><i class="fa fa-folder-open fa-fw stroke-transparent"></i> Travel</a>
												</div>
												<div class="blog-item-bookmark bookmark">
													<a href="#"><i class="fa fa-glasses stroke-transparent"></i></a>
												</div>
											</div>
											<div class="card-body">
												<h2 class="card-title">Post Title</h2>
												<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
												Reiciendis aliquid atque, nulla?</p>
												<a href="post.php" class="read-more-link">Read More <i class="fa fa-angle-right"></i></a>
											</div>
											<div class="card-footer text-muted">
												By Joseph Wamulume
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<hr>

					


				</div>

				<!-- Sidebar Widgets Column -->
				<div class="col-lg-4 sidebar-widgets-column">

					<!-- Search Form -->
					<div class="card shadow search-widget">
						<form>
							<div class="card-body">
								<div class="input-group">
									<input type="search" class="form-control border-right-0" placeholder="Search">
									<span class="input-group-prepend">
										<button class="btn input-group-text bg-white border-left-0">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
							</div>
						</form>
					</div>

					<!-- Categories -->
					<div class="card my-4 shadow categories-widget">
						<h5 class="card-header">Categories</h5>
						<div class="card-body">
							<ul>
								<li>
									<a href="">Travel</a>
								</li>
								<li>
									<a href="">News</a>
								</li>
								<li>
									<a href="">Finance</a>
								</li>
								<li>
									<a href="">Music</a>	
								</li>
								<li>
									<a href="">Design</a>
								</li>
								<li>
									<a href="">Animals</a>
								</li>
							</ul>
						</div>
					</div>

      			</div>

			</div>
			
			<div class="row">
				<div class="col-lg-8 blog-post">
					<div class="row blog-section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Leave a comment</h2>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<form>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>First Name</label>
										<input class="form-control" type="text" name="firstname" required>
									</div>
									<div class="form-group col-md-6">
										<label>Last Name</label>
										<input class="form-control" type="text" name="lastname" required>
									</div>
								</div>
								<div class="form-group">
									<label>Email Address</label>
									<input class="form-control" type="email" name="email" required>
								</div>
								<div class="form-group">
									<label>Comment</label>
									<textarea class="form-control" type="text" name="comment"></textarea>
								</div>
								<div>
									<button class="btn btn-submit">Submit</button>
								</div>
							</form>
						</div>
					</div>

					<hr>

					<div class="row blog-section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Comments (5)</h2>
							</div>
						</div>
					</div>

					<div>
						<ul class="comment-list">
							<li class="comment">
								<div class="vcard bio">
									<img src="../img/user-profile-avatar.jpg" alt="Image">
								</div>
								<div class="comment-body">
									<h3>Joseph Wamulume</h3>
									<div class="meta">July 7, 2020 at 5:21pm</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
									<p><a href="#" class="reply"><i class="fa fa-reply fa-fw"></i> Reply</a></p>
								</div>
								<ul class="children">
									<li class="comment">
									<div class="vcard bio">
										<img src="../img/user-profile-avatar.jpg" alt="Image placeholder">
									</div>
									<div class="comment-body">
										<h3>Joseph Wamulume</h3>
										<div class="meta">July 7, 2020 at 5:21pm</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
									</div>
									</li>
									<li class="comment">
									<div class="vcard bio">
										<img src="../img/user-profile-avatar.jpg" alt="Image placeholder">
									</div>
									<div class="comment-body">
										<h3>Joseph Wamulume</h3>
										<div class="meta">July 7, 2020 at 5:21pm</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
									</div>
									</li>
								</ul>
							</li>
							<li class="comment">
								<div class="vcard bio">
									<img src="../img/user-profile-avatar.jpg" alt="Image">
								</div>
								<div class="comment-body">
									<h3>Joseph Wamulume</h3>
									<div class="meta">July 7, 2020 at 5:21pm</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
									<p><a href="#" class="reply"><i class="fa fa-reply fa-fw"></i> Reply</a></p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>

		<!-- /.Content -->

		<!-- Footer -->

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

		<!-- /.Footer -->

	</body>

</html>