<?php

	session_start();

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - About</title>
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
								<li><a href="/">Home</a></li>
								<li class="current"><a href="/about">About</a></li>
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

				</section>

			<!-- Main -->
				<section id="main">
					<div class="container">

						<!-- Content -->
							<article class="box post">
								<header>
									<h2>About us</h2>
								</header>
								<p>
									CNBC Crypto World features the latest news and daily trading updates from the digital currency markets and provides viewers a look at what’s ahead with high-profile interviews, explainers and unique stories from the ever-changing crypto industry.
								</p>
								<section>
									<header>
										<h3>About crypto</h3>
									</header>
									<p>
										Cryptocurrencies have captured the attention and imagination of a new generation of investors across the globe. From Bitcoin to Ethereum to the growing list of altcoins, there’s little question that the volatile and fast-moving crypto industry keeps participants, observers, and regulators on edge. More and more, though, mainstream companies are looking at cryptocurrencies and adjacent technologies as a way to tap into new markets—or to create them from scratch in new, virtual worlds. 
									</p>
								</section>
								<video width="100%" controls>
									<source src="/videos/crypto_in_5_minutes.mp4" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</article>
					</div>
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
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/browser.min.js"></script>
			<script src="/assets/js/breakpoints.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<script src="/assets/js/main.js"></script>

	</body>
</html>