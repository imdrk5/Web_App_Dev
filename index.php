<?php

	session_start();

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">

					<!-- Logo -->
						<h1><a href="/">Daily Dose of Crypto</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li class="current"><a href="/">Home</a></li>
								<li><a href="/about">About</a></li>
								<li><a href="/news">News</a></li>
								<li><a href="/contact">Contact</a></li>
								<li>
									<a href="#"><i class="icon solid alt fa-user"></i></a>
									<ul>
										<?php
											if(isset($_SESSION['userID']))
											{
												echo "<li><a href='/backoffice'>Backoffice</a></li>";
											}
											else
											{
												echo "<li><a href='/register'>Register</a></li>
												<li><a href='/signin'>Sign In</a></li>";
											}
										?>
									</ul>
								</li>
							</ul>
						</nav>

					<!-- Banner -->
						<section id="banner">
							<header>
								<h2>Welcome to Daily Dose of Crypto!</h2>
								<p>Your Nº1 Crypto News Website</p>
							</header>
						</section>

					<!-- Intro -->
						<section id="intro" class="container">
							<div class="row">
								<div class="col-4 col-12-medium">
									<section class="first">
										<i class="icon solid featured fa-comments-dollar"></i>
										<header>
											<h2>Trending Cryptos</h2>
										</header>
										<p>Giving updates on the most trending cryptos out there!</p>
									</section>
								</div>
								<div class="col-4 col-12-medium">
									<section class="middle">
										<i class="icon solid featured alt fa-business-time"></i>
										<header>
											<h2>Daily Content</h2>
										</header>
										<p>Get daily updates on the market.</p>
									</section>
								</div>
								<div class="col-4 col-12-medium">
									<section class="last">
										<i class="icon solid featured alt2 fa-rocket"></i>
										<header>
											<h2>To the Moon!</h2>
										</header>
										<p>Helping you invest in the best cryptos in upward trend!</p>
									</section>
								</div>
							</div>
						</section>

				</section>

			<!-- Footer -->
				<section id="footer">
					<div class="col-12">
						<!-- Copyright -->
						<div id="copyright">
							<ul class="links">
								<li>Copyright &copy; 2022</li><li><a href="/">Rafael Amaral</a></li>
							</ul>
						</div>
					</div>
				</section>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>