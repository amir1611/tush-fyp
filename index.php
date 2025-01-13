<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="assets/images/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
		rel="stylesheet">

	<title>NetConfig Generator</title>

	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="assets/css/fontawesome.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
	<!-- ***** Preloader Start ***** -->
	<div id="preloader">
		<div class="jumper">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	<!-- ***** Preloader End ***** -->

	<!-- Header -->
	<header>
		<nav class="navbar navbar-expand-lg">
			<div class="container">
				<a class="navbar-brand" href="index.php">
					<h2>NetConfig <em>Generator</em></h2>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
					aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li
							class="nav-item <?php echo (!isset($_GET['page']) || $_GET['page'] === 'home') ? 'active' : ''; ?>">
							<a class="nav-link" href="index.php?page=home">Home</a>
						</li>
						<li
							class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'generator') ? 'active' : ''; ?>">
							<a class="nav-link" href="index.php?page=generator">Generator</a>
						</li>
						<li
							class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'about') ? 'active' : ''; ?>">
							<a class="nav-link" href="index.php?page=about">About</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- Page Content -->
	<div class="container">
		<?php
		// Check if 'page' parameter is set in the URL
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			switch ($page) {
				case 'home':
					// Home page content
					include 'home.php';
					break;
				case 'generator':
					include 'generator.php';
					break;
				case 'about':
					include 'about.php';
					break;
				default:
					include 'home.php';
					break;
			}
		} else {
			include 'home.php';
		}
		?>
	</div>

	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner-content">
						<p>Copyright © 2025 NetConfigGenerator <br> Built By Tusharan</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Additional Scripts -->
	<script src="assets/js/custom.js"></script>
	<script src="assets/js/owl.js"></script>
</body>

</html>