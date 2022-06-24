<?php

	session_start();
	
	include('../assets/php/database_connection.php');
	include('../assets/php/functions.php');

	$id = $email = $pw = "";
	$emailErr = $pwErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else {
			$email = test_input($_POST["email"]);
			$sql = "SELECT id, password, perms FROM users WHERE email = '$email';";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			$pw = test_input($_POST["pw"]);
			if ($result->num_rows > 0) {
				if($row['perms']) {
					if (password_verify($pw, $row['password'])) {
						$_SESSION['userID'] = $row['id'];
						header("Location: ../backoffice");
					} else {
						$pwErr = "Your password is incorrect";
					}
				}
				else {
					$emailErr = "You don't have permission to login";
				}
			}
			else {
				$emailErr = "You have to use a registered email";
			}
		}
	}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - Signin</title>
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
									<h2>Sign In</h2>
								</header>
								<form action="" id="login_form" name="login_form" method="POST">
									<label for="email">E-mail <?php echo '<span class="error">' . $emailErr . '</span>';?></label>
									<input type="email" id="email" name="email" placeholder="Your email" required="">
									<br>
									<label for="pw">Password <?php echo '<span class="error">' . $pwErr . '</span>';?></label>
									<input type="password" id="pw" name="pw" placeholder="Your password" required="">
									<br>
									<input type="submit" value="Login">
								</form>
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