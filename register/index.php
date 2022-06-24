<?php

	include('../assets/php/database_connection.php');
	include('../assets/php/functions.php');

	$name = $email = $pw = $pwconfirm = $birthday = $country = "";
	$nameErr = $emailErr = $pwErr = $pwconfirmErr = $birthdayErr = $countryErr = "";

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
		  	} else {
				$sql = "SELECT id, password FROM users WHERE email = '$email';";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					$emailErr = "You must use un unregistered email";
				}
			}
		}

		if (empty($_POST["pw"])) {
			$pwErr = "Password is required";
		} else {
			$pw = test_input($_POST["pw"]);

			$uppercase = preg_match('@[A-Z]@', $pw);
			$lowercase = preg_match('@[a-z]@', $pw);
			$number    = preg_match('@[0-9]@', $pw);
			$specialChars = preg_match('@[^\w]@', $pw);

			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pw) < 8) {
				$pwErr = "Password must be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
			}
		}

		if (empty($_POST["pwconfirm"])) {
			$pwconfirmErr = "Password Confirmation is required";
		} else {
			$pwconfirm = test_input($_POST["pwconfirm"]);

			if($pwconfirm != $pw){
				$pwconfirmErr = "Password confirmation must match with the password";
			}
		}

		if (empty($_POST["birthday"])) {
			$birthdayErr = "Birthday date is required";
		} else {
			$birthday = test_input($_POST["birthday"]);
		}

		if (empty($_POST["country"])) {
			$countryErr = "Country is required";
		} else {
			$country = test_input($_POST["country"]);
		}

		if($nameErr == "" && $emailErr == "" && $pwErr == "" && $pwconfirmErr == "" && $birthdayErr == "" && $countryErr == "")
		{
			//REDIRECT TO SUCESSFULL REGISTER PAGE
			$sql = "INSERT INTO Users (email, password, name, birthday, country) VALUES
			('" . $email . "', '" . password_hash($pw, PASSWORD_DEFAULT) . "', '" . $name . "', '" . $birthday . "', " . $country .")";
			$result = $conn->query($sql);
			echo "<p style='color:white;'>" . ucfirst(strtolower($name)) . ", your account was sucessfully registered! </p>";
		}
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>DDC - Register</title>
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
									<h2>Register</h2>
									<br>
									<span class="mandatory">Please fill all the mandatory fields (*)</span>
								</header>
								<form action="" id="register_form" name="register_form" method="POST">
									<label for="fname">Name<span class="mandatory">*</span> <?php echo '<span class="error">' . $nameErr . '</span>';?></label>
									<input type="text" id="name" name="name" placeholder="Your name" required="" <?php if($nameErr == ""){ echo "value=" . $name; } ?>>
									<br>
									<label for="email">E-mail<span class="mandatory">*</span> <?php echo '<span class="error">' . $emailErr . '</span>';?></label>
									<input type="email" id="email" name="email" placeholder="Your email" required="" <?php if($emailErr == ""){ echo "value=" . $email; } ?>>
									<br>
									<label for="pw">Password<span class="mandatory">*</span> <?php echo '<span class="error">' . $pwErr . '</span>';?></label>
									<input type="password" id="pw" name="pw" placeholder="Your password" required="">
									<br>
									<label for="pwconfirm">Confirm Password<span class="mandatory">*</span> <?php echo '<span class="error">' . $pwconfirmErr . '</span>';?></label>
									<input type="password" id="pwconfirm" name="pwconfirm" placeholder="Confirm your password" required="">
									<br>
									<label for="birthday">Birthday<span class="mandatory">*</span> <?php echo '<span class="error">' . $birthdayErr . '</span>';?></label>
									<input type="date" id="birthday" name="birthday" min='1900-01-01' max="<?= date('Y-m-d'); ?>" placeholder="Birthday" required="" <?php if($birthdayErr == ""){ echo "value=" . $birthday; } ?>>
									<br>
									<label for="country">Country<span class="mandatory">*</span> <?php echo '<span class="error">' . $countryErr . '</span>';?></label>
									<select id="country" name="country" required="">
										<option value="">Please select</option>
										<?php 
											$sql = "SELECT id, name FROM countries";
											$result = $conn->query($sql);
											
											if ($result->num_rows > 0) {
											  // output data of each row
											  while($row = $result->fetch_assoc()) {
												if($countryErr == "" && $country == $row['id'])
												{ 
													$sel = "selected";
												}
												else
												{
													$sel = "";
												}
												print '<option value="' . $row['id'] . '"' . $sel . '>' . $row['name'] . '</option>';
											  }
											}
										?>
									</select>
									<br>
									<input type="submit" value="Register">
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