<?php

	session_start();

	include('../assets/php/database_connection.php');
	include('../assets/php/functions.php');

	$name = $email = $subject = "";
	$nameErr = $emailErr = $subjectErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		} else {
			$name = test_input($_POST["name"]);
			if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed";
			}
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else {
			$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
		  	}
		}

		if (empty($_POST["subject"])) {
			$subjectErr = "Name is required";
		} else {
			$subject = test_input($_POST["subject"]);
		}

		if($nameErr == "" && $emailErr == "" && $subjectErr == "")
		{
			//REDIRECT TO SUCESSFULL REGISTER PAGE
			$sql = "INSERT INTO Messages (name, email, subject) VALUES
			('" . $name . "', '" . $email . "', '" . $subject ."')";
			$result = $conn->query($sql);
			echo "<p style='color:white;'>" . ucfirst(strtolower($name)) . ", your message was sucessfully sent! </p>";
		}
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - Contact</title>
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
								<li  class="current"><a href="/contact">Contact</a></li>
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
								<div class="col-8 col-12-medium">
									
									<!-- Content -->
									<article class="box post">
										<header>
										<h2>How can we help?</h2>
										</header>
										<form action="" id="contact_form" name="contact_form" method="POST">
											<label for="name">Name <span class="mandatory">*</span> <?php echo '<span class="error">' . $nameErr . '</span>';?></label>
											<input type="text" id="name" name="name" placeholder="Your name" required="">
											<br>
											<label for="email">Your E-mail <span class="mandatory">*</span> <?php echo '<span class="error">' . $emailErr . '</span>';?></label>
											<input type="email" id="email" name="email" placeholder="Your email" required="">
											<br>
											<label for="subject">Subject <span class="mandatory">*</span> <?php echo '<span class="error">' . $subjectErr . '</span>';?></label>
											<textarea id="subject" name="subject" placeholder="Message for the support" style="height:200px" resize="vertical" maxlength="255"></textarea>
											<br>
											<input type="submit" value="Send">
										</form>
									</article>

							</div>
							<div class="col-4 col-12-medium">

								<!-- Sidebar -->
									<section class="box">
										<header>
											<h3>Contacts</h3>
										</header>
										<p><b>Phone Nr.:</b> +351 910 000 000
										<br><b>Email:</b> support@ddcrypto.com</p>
										</p>
									</section>
									<section class="box">
										<header>
											<h3>Where to find us</h3>
										</header>
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3068.23199596974!2d-8.823231984764275!3d39.73443927945026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22735a4e067afb%3A0xcfaf619f4450fa76!2sPolit%C3%A9cnico%20de%20Leiria%20%7C%20ESTG%20-%20Escola%20Superior%20de%20Tecnologia%20e%20Gest%C3%A3o_Edif%C3%ADcio%20D!5e0!3m2!1sen!2spt!4v1655567602649!5m2!1sen!2spt" width="100%"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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