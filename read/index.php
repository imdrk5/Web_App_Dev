<?php

	session_start();

	include('../assets/php/database_connection.php');
	include('../assets/php/functions.php');

	$sql = "SELECT name, title, image, news.date_created FROM news JOIN users ON author = users.id WHERE news.id = " . $_GET['id'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - <?php echo $row['title'];?></title>
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
								<li><a href="/about">About</a></li>
								<li class="current"><a href="/news">News</a></li>
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
						<div class="row">
							<div class="col-4 col-12-medium">

								<!-- Sidebar -->
									<section class="box">
										<header>
											<h3><?php echo $row['name'];?></h3>
										</header>
										<p><b>Posted on: </b> <?php echo date("d-m-Y | h:i A", strtotime($row['date_created']));?></p> 	
									</section>
							</div>
							<div class="col-8 col-12-medium imp-medium">

								<!-- Content -->
									<article class="box post">
										<a class="image featured"><img src="/images/news/<?php echo $row['image'];?>" alt="" /></a>
										<header>
											<h2><?php echo $row['title'];?></h2>
										</header>
										<?php
											$sql = "SELECT subtitle, text FROM sections WHERE news_id = " . $_GET['id'];
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													echo "<div>";
													echo "<h1>" . $row['subtitle'] . "</h1>";
													echo "<p>" . $row['text'] . "</p>";
													echo "</div>";
												}
											}
										?>
									</article>

							</div>
						</div>
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