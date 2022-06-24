<?php

	session_start();

	if(!isset($_SESSION['userID']))
	{
		header("Location: ../../");
	}

	include('../assets/php/database_connection.php');
	include('../assets/php/functions.php');
	

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - Panel</title>
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
								<li class="current"><a href="/backoffice">Panel</a></li>
								<li><a href="/backoffice/table/?sub=Users">Users</a></li>
								<li>
									<a href="">News</a>
									<ul>
										<li><a href="/backoffice/table/?sub=News">Table</a></li>
										<li><a href="/backoffice/write/">Write</a></li>
									</ul>
								</li>
								<li><a href="/backoffice/table/?sub=Messages">Messages</a></li>
								<li>
									<?php
										$sql = "SELECT name FROM users WHERE id = " . $_SESSION['userID'];
										$result = $conn->query($sql);
										$row = $result->fetch_assoc();
									?>
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
									<h2>Panel</h2>
								</header>
								<!-- Panels -->
								<section id="intro" class="container">
									<div class="row">
										<div class="col-3 col-12-medium">
											<section class="middle">
												<header>
													<h2>Authors</h2>
												</header>
												<i class="icon solid featured alt fa-user"></i>
												<?php
													$sql = "SELECT COUNT(*) as Authors FROM users WHERE perms = TRUE";
													$result = $conn->query($sql);
													$row = $result->fetch_assoc();
												?>
												<p>There <?php if($row['Authors'] < 2){ echo "is <b>" . $row['Authors']; } else { echo "are <b>" . $row['Authors']; } ?></b> registered authors.</p>
											</section>
										</div>
										<div class="col-3 col-12-medium">
											<section class="middle">
												<header>
													<h2>Permissions</h2>
												</header>
												<i class="icon solid featured alt fa-user-clock"></i>
												<?php
													$sql = "SELECT COUNT(*) as Perms FROM users WHERE perms = False";
													$result = $conn->query($sql);
													$row = $result->fetch_assoc();
												?>
												<p>There <?php if($row['Perms'] < 2){ echo "is <b>" . $row['Perms']; } else { echo "are <b>" . $row['Perms']; } ?></b> unprivileged users.</p>
											</section>
										</div>
										<div class="col-3 col-12-medium">
											<section class="middle">
												<header>
													<h2>News</h2>
												</header>
												<i class="icon solid featured alt fa-newspaper"></i>
												<?php
													$sql = "SELECT COUNT(*) as News FROM news";
													$result = $conn->query($sql);
													$row = $result->fetch_assoc();
												?>
												<p>There <?php if($row['News'] < 2){ echo "is <b>" . $row['News']; } else { echo "are <b>" . $row['News']; } ?></b> news posted.</p>
											</section>
										</div>
										<div class="col-3 col-12-medium">
											<section class="middle">
												<header>
													<h2>Contact</h2>
												</header>
												<i class="icon solid featured alt fa-inbox"></i>
												<?php
													$sql = "SELECT COUNT(*) as msg FROM messages";
													$result = $conn->query($sql);
													$row = $result->fetch_assoc();
												?>
												<p>There <?php if($row['msg'] < 2){ echo "is <b>" . $row['msg']; } else { echo "are <b>" . $row['msg']; } ?></b> messages.</p>
											</section>
										</div>
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