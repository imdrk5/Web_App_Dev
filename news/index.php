<?php

	session_start();

	include('../assets/php/database_connection.php');
	include('../assets/php/functions.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - News</title>
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
						<div class="col-12">

							<!-- Blog -->
								<section>
									<header class="major">
										<h2>Recent News</h2>
									</header>
									<div class="row">
										<?php
											$sql = "SELECT news.id, name, title, image, news.date_created FROM news JOIN users ON author = users.id";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													$id = $row['id'];
													echo '<div class="col-6 col-12-small">';
													echo '<section class="box">';
													echo '<a class="image featured"><img src="/images/news/' . $row['image'] . '" alt="" /></a>';
													echo '<header>';
													echo '<h3>' . $row['title'] . '</h3>';
													echo '<p>' . $row['name'] . ' - Posted on ' . date("d-m-Y", strtotime($row['date_created'])) . '</p>';
													echo '</header>';
													echo '<footer>';
													echo '<ul class="actions">';
													echo '<li><a href="/read/?id=' . $id . '" class="button icon solid fa-file-alt">Read</a></li>';
													echo '</ul>';
													echo '</footer>';
													echo '</section>';
													echo '</div>';
												}
											}
										?>
									</div>
								</section>

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