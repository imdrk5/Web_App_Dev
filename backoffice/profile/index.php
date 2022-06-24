<?php

	session_start();

	if(!isset($_SESSION['userID']))
	{
		header("Location: ../../../");
	}

	include('../../assets/php/database_connection.php');
	include('../../assets/php/functions.php');

	$sql = "SELECT users.name as name, email, birthday, countries.name as country FROM users, countries WHERE users.country = countries.id AND users.id = " . $_SESSION['userID'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$date = new DateTime($row['birthday']);
	$now = new DateTime();
 	$interval = $now->diff($date);

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - <?php echo $row['name']; ?>'s Profile</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">

					<!-- Logo -->
						<h1><a href="/backoffice">DDC - Backoffice</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="/backoffice">Panel</a></li>
								<li><a href="/backoffice/table/?sub=Users">Users</a></li>
								<li>
									<a href="">News</a>
									<ul>
										<li><a href="/backoffice/table/?sub=News">Table</a></li>
										<li><a href="/backoffice/write/">Write</a></li>
									</ul>
								</li>
								<li><a href="/backoffice/table/?sub=Messages">Messages</a></li>
								<li class="current">
									<a href=""><i class="icon solid alt fa-user"></i> <?php echo $row['name'];?></a>
									<ul>
										<li><a href="/backoffice/profile/">Profile</a></li>
										<li><a href="/assets/php/signout.php">Sign Out</a></li>
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
									<h2>Profile</h2>
								</header>
								<!-- Panels -->
								<section id="intro" class="container">
									<div class="row">
										<div class="col-4 col-12-medium">
											<section class="middle">
												<header>
													<h2><?php echo $row['name']; ?></h2>
												</header>
												<i class="icon solid featured alt fa-user"></i>
											</section>
										</div>
										<div class="col-4 col-12-medium">
											<section class="right">
												<header>
													<h2 style="text-align: left;">Information</h2>
												</header>
												<p style="text-align: left;"><b>Name: </b><?php echo $row['name']; ?></p>
												<p style="text-align: left;"><b>Age: </b><?php echo $interval->y; ?></p>
												<p style="text-align: left;"><b>Country: </b><?php echo $row['country']; ?></p>
												<p style="text-align: left;"><b>Email: </b><?php echo $row['email']; ?></p>
											</section>
										</div>
										<div class="col-4 col-12-medium">
											<section class="right">
												<header>
													<h2>News</h2>
												</header>
												<i class="icon solid featured alt fa-newspaper"></i>
												<?php
													$sql = "SELECT COUNT(*) as news FROM news WHERE author = " . $_SESSION['userID'];
													$result = $conn->query($sql);
													$row = $result->fetch_assoc();
												?>
												<p>You wrote <b><?php echo $row['news'];?></b> news.</p>
											</section>
									</div>
								</section>
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